<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ModelUsers extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
  
  // loginValidation se provjerava s Auth::check() ili Auth::guest()

  /**
  *   Metoda vraća sve usere u obliku arraya.
  *   @return Array of users
  */
  public static function getUsers() { 

    $users = User::all(); 
    return $users;   
  }

  
  /**
  *   Kreira usera s zadanim parametrima, imam dodatnu obranu od spremanja usera s istim emailom/usernameom
  *   Važno: Password mora ranije biti u obliku hasha !
  *   Ako uspiješno kreira usera i njegovu statistiku (statistiku postavlja na početne vrijednosti) na njegov mail 
  *   šalje link za potvrdu accounta.
  *   @return True ako uspije
  *           False ako negdje se pojavi pogreška 
  */
  public static function createUser($name, $lastname, $email, $username, $password) {
    
    $validator = Validator::make(
          array(
              'name'     => $name,
              'lastname' => $lastname,
              'email'    => $email,
              'username' => $username, 
              'password' => $password
          ),
          array(
              'name'     => 'required',
              'lastname' => 'required',
              'email'    => 'required|email|unique:users',
              'username' => 'required|max:20|min:3|unique:users',
              'password' => 'required'
          )
    );

    if ($validator->fails()) {
           $messages = $validator->messages();   // The given data did not pass validation
           var_dump($messages); 
           return false;
    }


    $code = str_random(60); // generira aktivacijski kod 

    $user = User::create(array(
          'name'     => $name,
          'lastname' => $lastname,
          'email'    => $email,
          'username' => $username,
          'password' => $password,   // Hash::make($password),
          'code'     => $code,
          'active'   => 0
        ));

    if($user->save()) {
              // šalje email na uneseni email 
              // Mail::send('emails.auth.activate', array('link' => URL::route('account-activate',$code), 'username' => $username), function($message) use ($user) {
              //   /* use $user allows us to use $user-email */
              //   $message->to($user->email, $user->username)->subject('Activate your account'); 
              // });

        // kreira novu statistiku za novog user-a
        $statistic = new User_Statistics(); 
        $statistic->user_rank = '0'; 
        $statistic->total_bought_bookstore = '0';
        $statistic->total_bought_users = '0';
        $statistic->total_price_books = '0';
        $statistic->number_of_client_partners = '0';
        $user->statistics()->save($statistic);

        if(!file_exists(getcwd() . '/certificate/' . $username))
          mkdir(getcwd() . '/certificate/' . $username);

        try {
        // save $user + relationship
          $user->push(); 
        } catch (\Illuminate\Database\QueryException $e) {
                return false;
        }
        
        return true;
    
    } else { 
        return false;
    }
}

  /**
  *   Update-a predanog usera 
  *   @return True ako uspije
  *           False ako negdje se pojavi pogreška
  */
  public static function updateUser(User &$user) { 
    try {
      if($user->save()) {
             // return Redirect::route('home')->with('global','Your account is updated!');
            return true; 
      } else {
            //  return Redirect::route('home')->with('global', 'We could not update your account. Try again later');
            return false; 
      } 
    } catch (\Illuminate\Database\QueryException $e) {
            return false;
    }
  }


  /**
  *   Metoda vraća sve user->statistike u obliku arraya.
  *   Kada se prođe petljom po vraćenom arrayu ovisno o nazivu varijable koja se koristi može se pristupiti svim poljima tablice user_statistics 
  *   pomoću:  $imevarijable->total_price_books
  *   @return Array of user_statistics
  */
  public static function getUserStatistics($id) {

    $user = User::find($id); 
    $statistics = $user->statistics; 
    return $statistics; 
  }

  /**
  *   Metoda vraća statistiku knjižare.
  *   @return bookstore_statistics entry
  */
  public static function getBookstoreStatistics() {

    return DB::table('bookstore_statistics')->first();
  }


  /**
  *  Update-a statistiku predanog usera i knjige koju je kupio , ovisno o informacijama o stacku te knjige 
  *  uređuje user statistiku.
  *  @param Book &$book - knjiga koju treba updateati, mora biti konkretna instanca vec postojece knjige
  *  @param User $user  - user čija statistika se update-a
  *  @return True ako uspije
  *          False ako negdje se pojavi pogreška 
  */
  public static function updateUserStatistics(User $user, Book $book) {
      
      $seller = $book->stack->client_with_lowest_price;
      $price = $book->stack->price;


      if ($seller == 1) { 
        $user->statistics->total_bought_bookstore++;
        $user->statistics->total_price_books = ($user->statistics->total_price_books) + $price; 
      
      } else {
        $user->statistics->total_bought_users++;
        $user->statistics->total_price_books = ($user->statistics->total_price_books) + $price;
        //treba napravit
        // if (User::find($seller) in $user->)
          $user->statistics->number_of_client_partners++;
      }
      
      ModelUsers::recalculateRanck($user);
      try {  
          if ($user->statistics->save()) return true;  
              return false;
         } catch (\Illuminate\Database\QueryException $e) {
              return false;
         }

      ModelUsers::recalculateRanck($user);
  }

  public static function recalculateRanck($user) {
      $ranck = 0;
      $ranck += ($user->statistics->total_bought_bookstore + $user->statistics->total_bought_users) / 5;
      $ranck += $user->statistics->total_price_books / 1200;
      $ranck += $user->statistics->number_of_client_partners / 5;
      
      $user->statistics->user_rank = $ranck;
      $user->push();
  }

  /**
  *  Metoda provjerava user-ov active redak (0 nije registriran , 1 registriran) prema predanom id-u.
  *  @return True ako je user registriran 
  *          False ako user nije registriran 
  */
  public static function registerValidation($id) {

    $user = User::find($id); 
    if ($user->active) {  
      return true; 
    } else { 
      return false; 
    } 
  }

  /**
  *  Metoda vraća broj partnera svakog usera u obliku arraya
  *  @return Array of broj klijenata-partnera
  */
  public static function getPartners() { 
    
    $users = User::all(); 
    $partners = array(); 
    foreach($users as $user ) {
      array_push($partners, $user->statistics->number_of_client_partners); 
    }
    return $partners; 
  }
  
  /**
  *  Metoda vraća sve komentare u obliku arraya prema zadanom id-u knjige.
  *  @return Array of comments
  */
  public static function getComments_book($id) {
   
    $book = Book::find($id); 
    $comments=array(); 
    // book->userComments is a Collection of comments (many-to-many relationship #)
    foreach($book->userComments as $userComment) {
      array_push($comments, array(
        'comment' => $userComment->pivot->comment,
        'comment_time' => $userComment->pivot->created_at,
        'username' => User::find($userComment->pivot->user_id)->username
      ));
    }
    return $comments; 
  }

  /**
  * Metoda sprema komentar u bazu podataka. 
  * @param User $user - user koji je dao komentar
  * @param Book $book - knjiga koju je komentirao
  * @param $comment   - sadržaj komentara
  */
  public static function saveComment(User $user, Book $book,  $comment) {

    $book->userComments()->attach($user->id, array('comment' => $comment));
    // parametri su mixed id, array atributtes i po defaultu trenutno vrijeme 
    // calls on $book then needs $user id
  }
  

  /**
  *  Metoda vraća sve ocjene u obliku arraya prema zadanom id-u knjige.
  *  @return Array of grades
  */
  public static function getGrades($id) {
    
    $book = Book::find($id); 
    $grades = array();
    foreach($book->userGrades as $grade) {
      array_push($grades, $grade->pivot->grade); 
    }
    return $grades; 
  }

  /**
  * Metoda sprema ocjenu  u bazu podataka. 
  * @param User $user - user koji je dao ocjenu
  * @param Book $book - knjiga koju je ocjenio
  * @param $grade   - ocjena knjige
  */
  public static function saveGrade($user, $book, $grade) {
    $old_grade = DB::table('rating_book')
                    ->where('user_id', '=', $user->id)
                    ->where('book_id_foreign', '=', $book->book_id)
                    ->get(); 
    if( $old_grade == null) {
      $book->userGrades()->attach($user->id, array('grade' => $grade));
    } else { 
      $book->userGrades()->updateExistingPivot($user->id, array('grade' => $grade));
    }
  }


  /**
  * Metoda dohvaća sve knjige koje je kupio predani user.
  * @param User $user njegov popis kupljenih knjiga
  * @return Array of titles
  */
  public static function getBoughtBooks(User $user) {

    $bought_books = array(); 
    $titles = array(); 
    $purchases = array(); 
    foreach($user->purchases as $purchase) {
      
      $id = $purchase->pivot->book_id_foreign; 
      $book = Book::find($id); 
      array_push($purchases, $purchase); 
      array_push($bought_books, $purchase->pivot->book_id_foreign);
      array_push($titles, $book->book_title); 
    }
    //return $titles; // array of book titles
    // return $bought_books; // array of book ids
    return $purchases; // array kupnji iz tablice 
  }



}

