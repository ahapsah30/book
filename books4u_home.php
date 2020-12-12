<?php
# For the configuration of Database
include("config.php");

$table_name_post="posts";
$table_name_categories="category";
$table_name_comments="comments";
$table_name_user="users";
$table_name_update="Updates";
$table_name_favourites="favourites";
$table_name_policy="policy";
$table_name_artist="artist";
$table_name_admob="admob";
$table_name_report="report";
$table_name_verification="verification";

$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST["functionality"])) {
$object=$_POST["functionality"];
}


if (isset($_SERVER['HTTP_AUTHORIZED_API_KEY'])){
	$apiKey=$_SERVER['HTTP_AUTHORIZED_API_KEY'];


	if(!checkApiKeyVerification( validate($apiKey) ) ){
		$object="failed";	



	}	

}else{
	$object="failed";
}


if (isset($_POST["status"])) {
$status=$_POST["status"];
}

if (isset($_POST["required"])) {
$requiredCounter=$_POST["required"];
}

if (isset($_POST["first_name"])) {
$fname=$_POST["first_name"];
}

if (isset($_POST["last_name"])) {
$lname=$_POST["last_name"];

}

if (isset($_POST["email"])) {
$email=$_POST["email"];
}

if (isset($_POST["picture"])) {
$avatar=$_POST["picture"];
}

if (isset($_POST["password"])) {
$password=$_POST["password"];
}

if (isset($_POST["search_item"])) {
$search_item=$_POST["search_item"];
}

if (isset($_POST["search_type"])) {
$search_type=$_POST["search_type"];
}

if (isset($_POST["search_filter"])) {
$search_filter=$_POST["search_filter"];
}

if (isset($_POST["post_id"])) {
$postId=$_POST["post_id"];
}

if (isset($_POST["tags"])) {
$tags=$_POST["tags"];
}

if (isset($_POST["user_id"])) {
$userId=$_POST["user_id"];
}

if (isset($_POST["comment"])) {
	
 $comment=validate($_POST["comment"]);
 $comment=mysql_real_escape_string($comment);


}


if (isset($_POST["cat_id"])) {
$catId=$_POST["cat_id"];
}

if (isset($_POST["artist_id"])) {
$artistId=$_POST["artist_id"];
}

if (isset($_POST["type"])) {
$type=$_POST["type"];
}

if (isset($_POST["rating"])) {
$rating=$_POST["rating"];
}

if (isset($_POST["userType"])) {

  $userType=$_POST["userType"];

}

if (isset($_POST["uid"])) {

  $uid=$_POST["uid"];

}


if ($object=="categorized_book") {
	# For retrieving all categories
	getCategorizedBook($catId);

}elseif ($object=="all_artist") {
	# For retrieving all categories
	getAllArtist();

}elseif ($object=="specific_artist_stream") {
  # For retrieving all categories
  getSpecificArtist($artistId);   

}elseif ($object=="specific_artist_detail") { 

getSpecificArtistBooks($artistId);

}elseif ($object=="admob_configuration") {
  # For retrieving all categories
  getAdmobConfiguration();

}elseif ($object=="categorized_video") {
	# For retrieving all categories
	getCategorizedVideo($catId);

}elseif ($object=="all_categories") {
	# For retrieving all categories
	getAllCategories();

}elseif ($object=="home") {
	# For retrieving Top Trending Photos
	getHomeListing($catId);

}elseif ($object=="popular") {
	# For retrieving Top Trending Photos
	getPopular();

}elseif ($object=="latest") {
	# For retrieving Top Trending Photos
	getLatest();

}elseif ($object=="newsfeed") {
	# For retrieving Top Trending Photos
	getNewsFeed($catId);

}elseif ($object=="trending_videos") {
	# For retrieving Top Trending Videos
	getTrendingVideos();

}elseif ($object=="login") {
  # For authenticate User
  login($email,$password,$userType,$uid);

}elseif ($object=="register") {
  # For registering User

  register($email,$password,$fname,$lname,$avatar,$userType,$uid);

}elseif ($object=="specific_book_detail") {
	# For specific book detail

	getSpecificBookDetail($postId,$tags);

}elseif ($object=="all_comments") {
	# For retrieving Comments
	getAllComments($postId);

}elseif ($object=="add_comments") {
	# Adding comments
	addComment($postId,$userId,$comment,$rating);

}elseif ($object=="add_favourites") {
	# Adding favourites
	addFavourites($postId,$userId);

}elseif ($object=="favourites") {
	# Retrieving favourites
	getFavourites($userId);

}elseif ($object=="delete_favourites") {
	# Delete favourites
	deleteFavourites($postId,$userId);

}elseif ($object=="update_profile") {
	# Delete favourites
	updateProfile($userId,$fname,$lname,$email,$password,$avatar);

}elseif ($object=="forgot_password") {
	# Reset password request
	forgotPassword($email);

}elseif ($object=="privacy") {
	# Reset password request
	getPrivacyPolicy();

}elseif ($object=="search") {
	# For finding Specific Wallpaper

	searchPost($search_type,$search_item);

}elseif ($object=="counter") {
	# code...

	if ($requiredCounter == "download") {
		getCounter($postId,$requiredCounter);
	}else if ($requiredCounter == "likes") {
		getCounter($postId,$requiredCounter);
	}else if ($requiredCounter == "dislikes") {
		getCounter($postId,$requiredCounter);
	}

}elseif ($object=="add_report") {
	# Adding favourites
	addReport($userId,$postId,$comment);

}elseif ($object=="specific_author_detail") {
  # Adding favourites
  getSpecificAuthorDetail($postId);

}elseif ($object=="specific_book") {
  # Adding favourites
  getSpecificBook($postId);

}






/*

It is used for formatting of Trending Data into Object

*/
class Trending 
{

	public $code="";
	public $message="";
	public $featured=[];
	public $category=[];
    public $trending=[];
    public $newly=[];
    public $artist=[];
    public $comments=[];

} 


/*

It is used for formatting of Trending Data into Object

*/
class PrivacyPolicy 
{

	public $code="";
	public $message="";
	public $privacy="";

}    


/*

It is used for formatting of Category Data into Object

*/
class Category 
{

	public $code="";
	public $message="";
	public $categories=[];

}  



/*

It is used for formatting of Category Data into Object

*/
class Comment 
{

	public $code="";
	public $message="";
	public $comments=[];

}  


/*

It is used for formatting of Category Data into Object

*/
class Ads 
{

  public $code="";
  public $message="";
  public $ads=[];

}  



/*

It is used for formatting of User Data into Object

*/
class User 
{

	public $code="";
	public $message="";
	public $userId;
  public $userType;
	public $fName;
	public $lName;
	public $email;
	public $pass;
	public $avatar;
	public $isEnable;

}  



/*

It is used for formatting of Favourites Data into Object

*/
class Favourites 
{

	public $code="";
	public $message="";
	public $favourites=[];

}  



 class Post {

 		public $id;
      	public $cat_id;
      	public $title;
      	public $description;
      	public $postType;
      	public $coverUrl;
      	public $originalUrl;
      	public $videoUrl;
      	public $likes;
      	public $dislikes;
      	public $downloads;
      	public $comments;

 }



function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars(strip_tags($data, ENT_QUOTES));
  return $data;
}



function checkApiKeyVerification($apiKey){

  $isVerified;
  $table=$GLOBALS['table_name_verification'];
  $query="SELECT * FROM $table WHERE api='$apiKey' AND type ='rest_api_authorization' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 


  if ($count>0) {
   $isVerified=true;
  }else{
  	$isVerified=false;
  }

 return $isVerified;

}


function getSpecificAuthorDetail($id){

  $table=$GLOBALS['table_name_artist'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND id ='$id' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  $trending=new Trending(); 
  $artist = [];

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($artist, [
        'id'   => $row['id'],
        'category' => $row['title'],
        'pictureUrl' => $row['pictureUrl'],
        'description' => $row['description'],
        'bookCount' => getArtistBooksCount($row['id']),
        'reviewCount' => getArtistBooksReviewCount($row['id']),   
        'downloadcount'   => getArtistBooksDownloadCount($row['id']) 
              
      ]);
   
    }

  }


   if ( count($artist)>0 ) {
    
  
    $trending -> artist=$artist;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

  }else{

    $trending -> code="206";
    $trending -> message="No data available";

  }
  

  $result = json_encode($trending);
   echo "$result";

}


function getSpecificBook($id){

  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND id ='$id' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  $trending=new Trending(); 
  $book = [];

  if ($count>0) {

    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($book, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  }


   if ( count($book)>0 ) {
    
  
    $trending -> trending=$book;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

  }else{

    $trending -> code="206";
    $trending -> message="No data available";

  }
  

  $result = json_encode($trending);
   echo "$result";

}



/*

It is used to get Home listing

*/
function getHomeListing($catId)
{

  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isFeatured='1' AND isEnable='0' AND singleStation='0' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  $trending=new Trending();	
  $featured = [];
  $category = [];
  $trendings = [];
  $newly = [];
  $artist = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($featured, [
      	'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
      	'cat_id' => $row['cat_id'],
      	'title'   => $row['title'],
      	'description' => $row['description'],
        'tags' => $row['tags'],
      	'postType'   => $row['postType'],
      	'coverUrl'   => $row['coverUrl'],
      	'originalUrl'   => $row['originalUrl'],
      	'likes'   => $row['likes'],
      	'dislikes'   => $row['dislikes'],
      	'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
      	'comments'   => getPostComments($row['id']),
      	'rating'  => getPostRating($row['id'])     	
  		]);
   
   		 }

   		 }


  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0' AND isFeatured='0' ORDER BY downloads DESC LIMIT 5";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($trendings, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  	}

  $tableCategory=$GLOBALS['table_name_categories'];
  $query="SELECT * FROM $tableCategory ORDER BY id DESC LIMIT 5";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
 

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($category, [
      	'id'   => $row['id'],
      	'category' => $row['title'],
      	'pictureUrl'   => $row['pictureUrl']    	
  		]);
   
    }

		}


  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0' AND isFeatured='0' AND cat_id='$catId' ORDER BY id DESC LIMIT 2";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($newly, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  }


  $table=$GLOBALS['table_name_artist'];
  $query="SELECT * FROM $table WHERE isEnable='0' ORDER BY id DESC LIMIT 5";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($artist, [
        'id'   => $row['id'],
        'category' => $row['title'],
        'pictureUrl' => $row['pictureUrl'],
        'description' => $row['description'],
        'bookCount' => getArtistBooksCount($row['id']),
        'reviewCount' => getArtistBooksReviewCount($row['id']),		
        'downloadcount'   => getArtistBooksDownloadCount($row['id']) 
              
      ]);
   
    }

  }


  if (count($featured)>0 || count($trendings)>0 || count($newly)>0 || count($artist)>0 || count($category)>0 ) {
    
    $trending -> featured=$featured;
    $trending -> trending=$trendings;
    $trending -> category=$category;
    $trending -> newly=$newly;
    $trending -> artist=$artist;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

  }else{

    $trending -> code="206";
    $trending -> message="No data available";

  }
	

	$result = json_encode($trending);
   echo "$result";

}


/*

It is used to get Latest

*/
function getLatest(){


  $trending=new Trending();	
  $trendings = [];


  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0' AND isFeatured='0' ORDER BY id DESC LIMIT 10";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($trendings, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  	}


  	if (count($trendings)>0) {
    

    $trending -> trending=$trendings;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

    }else{

    $trending -> code="206";
    $trending -> message="No data available";

    }
	

   $result = json_encode($trending);
   echo "$result";

}




function getArtistBooksCount($artistId){

  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0'  AND artist_id='$artistId' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  return $count;

}


function getArtistBooksReviewCount($artistId){

  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0'  AND artist_id='$artistId' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  $review=0;

  if ($count>0) {
  	
  	while ($row = mysql_fetch_assoc($result)) {

  		$review+=getBookReviewCount($row['id']);
   
    }

    


  }

  return $review;

}


function getBookReviewCount($postId){

  $table=$GLOBALS['table_name_comments'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND post_id='$postId' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  return $count;

}



function getArtistBooksDownloadCount($artistId){

  $table=$GLOBALS['table_name_post'];
  $query="SELECT SUM(downloads) AS downloadCount FROM $table WHERE isEnable='0' AND singleStation='0'  AND artist_id='$artistId' ";
  $result=mysql_query($query) OR die(mysql_error());
  $row = mysql_fetch_assoc($result); 
  $sum = $row['downloadCount'];
  //$count=mysql_num_rows($result); 

  return $sum;

}



function getPopular(){


  $trending=new Trending();	
  $trendings = [];


  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0' AND isFeatured='0' ORDER BY downloads DESC LIMIT 10";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($trendings, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  	}


  	if (count($trendings)>0) {
    

    $trending -> trending=$trendings;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

    }else{

    $trending -> code="206";
    $trending -> message="No data available";

    }
	

   $result = json_encode($trending);
   echo "$result";

}



function getNewsFeed($catId){


  $trending=new Trending();	
  $trendings = [];


  $table=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $table WHERE isEnable='0' AND singleStation='0' AND isFeatured='0' AND cat_id='$catId' ORDER BY id DESC LIMIT 10";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($trendings, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  	}


  	if (count($trendings)>0) {
    

    $trending -> trending=$trendings;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

    }else{

    $trending -> code="206";
    $trending -> message="No data available";

    }
	

   $result = json_encode($trending);
   echo "$result";

}



/*

It is used to get Home listing

*/
function getAllArtist()
{


  $trending=new Trending();	
  $artist = [];

 
  $table=$GLOBALS['table_name_artist'];
  $query="SELECT * FROM $table WHERE isEnable='0' ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
       array_push($artist, [
        'id'   => $row['id'],
        'category' => $row['title'],
        'pictureUrl' => $row['pictureUrl'],
        'description' => $row['description'],
        'bookCount' => getArtistBooksCount($row['id']),
        'reviewCount' => getArtistBooksReviewCount($row['id']),		
        'downloadcount'   => getArtistBooksDownloadCount($row['id']) 
              
      ]);
   
    }

  }


  if (count($artist)>0) {
    
    $trending -> artist=$artist;
    $trending -> code="202";
    $trending -> message="Data Retrieve Successfully";

  }else{

    $trending -> code="206";
    $trending -> message="No data available";

  }
	

	$result = json_encode($trending);
   echo "$result";

}



/*

It is used to get Top trending photos

*/
function getArtistName($userId)
{

  $table=$GLOBALS['table_name_artist'];
  $query="SELECT * FROM $table WHERE id='$userId' AND isEnable='0' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 
  
  $data = [];

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($data, [
        'id'   => $row['id'],
        'artist' => $row['title']
      ]);
   
    }
    
  }

  $artistName;

  if ($userId=="0") {
    $artistName="Admin";
  }else{
    $artistName=$data[0]['artist'];   
  }

  return $artistName;

}




/*

It is used to get Top trending photos

*/
function getAdmobConfiguration()
{

  $table=$GLOBALS['table_name_admob'];
  $query="SELECT * FROM $table";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 
  
  $ad=new Ads();
  $data = [];

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($data, [
        'admob_app_id'   => $row['admob_app_id'],
        'admob_banner_id' => $row['admob_banner_id'],
        'admob_interstitial_id' => $row['admob_interstitial_id'],
        'admob_publisher_id' => $row['publisher_id'],
        'admob_privacy_url' => $row['privacy_url']
      ]);
   
    }

    $ad -> code="202";
    $ad -> message ="Data Retrieve Successfully";
    $ad -> ads= $data;
    
  }else{

    $ad -> code="206";
    $ad -> message ="Failed to load data";

  }

  

  $result = json_encode($ad);
  echo "$result";

}



/*

It is used to get Top trending videos

*/
function getTrendingVideos()
{

  $tablePost=$GLOBALS['table_name_post'];
  $query_post="SELECT * FROM $tablePost WHERE postType='video' AND isEnable='0' ORDER BY downloads DESC LIMIT 40";
  $result_post=mysql_query($query_post) OR die(mysql_error());
  $count=mysql_num_rows($result_post);	
	
  $trending=new Trending();	
  $data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result_post)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
      	'cat_id' => $row['cat_id'],
      	'title'   => $row['title'],
      	'description' => $row['description'],
      	'postType'   => $row['postType'],
      	'coverUrl'   => $row['coverUrl'],
      	'originalUrl'   => $row['videoUrl'],
      	'likes'   => $row['likes'],
      	'dislikes'   => $row['dislikes'],
      	'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
      	'comments'   => getPostComments($row['id']),
      	'rating'  => getPostRating($row['id'])     	
  		]);
   
    }

     $trending -> trending=$data;
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
  	
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
	

	$result = json_encode($trending);
    echo "$result";

}


/*

It is used to get All Categories Data

*/
function getAllCategories()
{

  $tableCategory=$GLOBALS['table_name_categories'];
  $query="SELECT * FROM $tableCategory ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  $category=new Category();	
  $data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
      	'category' => $row['title'],
      	'pictureUrl'   => $row['pictureUrl']    	
  		]);
   
    }

     $category -> categories=$data;
     $category -> code="202";
     $category -> message="Data Retrieve Successfully";
  	
  }else{


    $category -> code="206";
    $category -> message="No data available";

  }
	

	$result = json_encode($category);
    echo "$result";

}



/*

It is used to get All Categories Data

*/
function getCategorizedBook($catId)
{

  $tablePost=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $tablePost WHERE cat_id='$catId' AND isEnable='0' AND singleStation='0' ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  $trending=new Trending();	
  $data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
      	'cat_id' => $row['cat_id'],
      	'title'   => $row['title'],
      	'description' => $row['description'],
      	'tags' => $row['tags'],
      	'postType'   => $row['postType'],
      	'coverUrl'   => $row['coverUrl'],
      	'originalUrl'   => $row['originalUrl'],
      	'likes'   => $row['likes'],
      	'dislikes'   => $row['dislikes'],
      	'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
      	'comments'   => getPostComments($row['id']),
      	'rating'  => getPostRating($row['id'])       	
  		]);
   
    }

     $trending -> trending=$data;
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
  	
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
	

	$result = json_encode($trending);
    echo "$result";

}








/*

It is used to get All Categories Data

*/
function getSpecificArtist($catId)
{

  $tablePost=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $tablePost WHERE artist_id='$catId' AND isEnable='0'  ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 
  
  $trending=new Trending(); 
  $data = [];

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($data, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id'])         
      ]);
   
    }

     $trending -> trending=$data;
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
    
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
  

  $result = json_encode($trending);
    echo "$result";

}



/*

It is used to get All Categories Data

*/
function getSpecificArtistBooks($catId)
{

  $tablePost=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $tablePost WHERE artist_id='$catId' AND isEnable='0'  ORDER BY downloads DESC LIMIT 5";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 
  
  $trending=new Trending(); 
  $data = [];
  $popular = [];
  $newly=[];

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {

     array_push($popular, $row['title']) ;	
  
      array_push($data, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])         
      ]);
   
    	}

	}


  $tablePost=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $tablePost WHERE artist_id='$catId' AND isEnable='0'  ORDER BY id DESC";
  //echo "$query";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 
 

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {


    	if (in_array($row['title'], $popular)) {
    		//echo "Workign";
    		continue;
    	}
  
      array_push($newly, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])            
      ]);
   
    	}

	}


	if (count($data)>0 || count($newly)>0 ) {

     $trending -> trending=$data;
     $trending -> newly=$newly;
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
    
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
  

  $result = json_encode($trending);
    echo "$result";

}



/*

It is used to get All Categories Data

*/
function getCategorizedVideo($catId)
{

  $tablePost=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $tablePost WHERE cat_id='$catId' AND isEnable='0' AND postType='video' ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  $trending=new Trending();	
  $data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
      	'cat_id' => $row['cat_id'],
      	'title'   => $row['title'],
      	'description' => $row['description'],
      	'postType'   => $row['postType'],
      	'coverUrl'   => $row['coverUrl'],
      	'originalUrl'   => $row['videoUrl'],
      	'likes'   => $row['likes'],
      	'dislikes'   => $row['dislikes'],
      	'downloads'   => $row['downloads'],
      	'comments'   => getPostComments($row['id'])       	
  		]);
   
    }

     $trending -> trending=$data;
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
  	
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
	

	$result = json_encode($trending);
    echo "$result";

}




/*

It is used to update the statistics of download , likes or dislikes

*/
function getCounter($id,$counterType)
{

	$tablePost=$GLOBALS['table_name_post'];
   	$query = "SELECT * FROM $tablePost WHERE id='$id'";
	$result=mysql_query($query) OR die(mysql_error());


	while ($row = mysql_fetch_assoc($result)) {

	 $download=$row['downloads'];
	 $likes=$row['likes'];
	 $dislikes=$row['dislikes'];

	}

	if ($counterType=="download") {

		$downloadCount=$download+1;		
		
	}elseif ($counterType=="likes") {

		$likeCount=$likes+1;
		
	}elseif ($counterType=="dislikes") {
		
		$dislikeCount=$dislikes+1;

	}

	if ($downloadCount==null) {
			$downloadCount=$download;
	}

	if ($likeCount==null) {
			$likeCount=$likes;
	}

	if ($dislikeCount==null) {
			$dislikeCount=$dislikes;
	}

	$query_update = "UPDATE $tablePost SET downloads='$downloadCount',likes='$likeCount',dislikes='$dislikeCount' WHERE id='$id'";
	$result_update=mysql_query($query_update);

}


/*

It is used to get Top trending videos

*/
function searchPost($postType,$keyword)
{

  $tablePost=$GLOBALS['table_name_post'];
  $tableAuthor=$GLOBALS['table_name_artist'];

  $trending=new Trending();	
  $data = [];


  if ($postType=="book") {
  		
  		
  		$query_post="SELECT * FROM $tablePost WHERE  isEnable='0' AND tags LIKE '%$keyword%' OR title LIKE '$keyword%' AND singleStation='0' ORDER BY id DESC";

  }elseif ($postType=="author"){

  		
  		$query_post="SELECT * FROM $tableAuthor WHERE isEnable='0' AND title LIKE '$keyword%'  ORDER BY id DESC";

  }
  
 
  $result_post=mysql_query($query_post) OR die(mysql_error());
  $count=mysql_num_rows($result_post);	
	
  
  if ($postType=="book") {
  		
  	// Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result_post)) {
  
      array_push($data, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])       
      ]);
   
    }

  }elseif ($postType=="author"){


  	  // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result_post)) {
  
      array_push($data, [
        'id'   => $row['id'],
        'category' => $row['title'],
        'pictureUrl' => $row['pictureUrl'],
        'description' => $row['description'],
        'bookCount' => getArtistBooksCount($row['id']),
        'reviewCount' => getArtistBooksReviewCount($row['id']),		
        'downloadcount'   => getArtistBooksDownloadCount($row['id']) 
              
      ]);
   
    }
  		

  }


  if ($count>0) {

  	  if ($postType=="book") {
  		
  		
  		 $trending -> trending=$data;

  		}elseif ($postType=="author"){

  		
  		 $trending -> artist=$data;

  		}
  

    
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
  	
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
	

	$result = json_encode($trending);
    echo "$result";

}



/*

It is used to get All Categories Data

*/
function getSpecificBookDetail($bookId,$tags)
{

  $postTags=explode(',',$tags);	
  $tablePost=$GLOBALS['table_name_post'];

  $trending=new Trending(); 
  $data = [];
  $comments = [];
  $column=[];
  //var_dump($postTags);

  foreach($postTags as $val)
  {
  
  $query="SELECT * FROM $tablePost WHERE FIND_IN_SET('$val',tags) AND isEnable='0'  AND id != '$bookId' LIMIT 5";
  //echo "$query";
  $result=mysql_query($query) OR die(mysql_error());

  while ($row = mysql_fetch_assoc($result)) {
			array_push($column,$row['id']);
   }
  //$column[]=$data['id'];
  
 
  } 

   if(count($column)>0){
  //var_dump(array_unique($column));
  $cond=implode(',',array_unique($column));
  
  $query="SELECT * FROM $tablePost WHERE id IN ($cond) LIMIT 5";
  //echo "$query";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {

     //array_push($popular, $row['title']) ;	
  
      array_push($data, [
        'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
        'cat_id' => $row['cat_id'],
        'title'   => $row['title'],
        'description' => $row['description'],
        'tags' => $row['tags'],
        'postType'   => $row['postType'],
        'coverUrl'   => $row['coverUrl'],
        'originalUrl'   => $row['originalUrl'],
        'likes'   => $row['likes'],
        'dislikes'   => $row['dislikes'],
        'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
        'comments'   => getPostComments($row['id']),
        'rating'  => getPostRating($row['id'])         
      ]);
   
    	}

	}

  }

	$comments=getAllComments($bookId);

	if (count($data)>0 || count($comments)>0 ) {

     $trending -> trending=$data;
     $trending -> comments=$comments;
     $trending -> code="202";
     $trending -> message="Data Retrieve Successfully";
    
  }else{


    $trending -> code="206";
    $trending -> message="No data available";

  }
  

  $result = json_encode($trending);
    echo "$result";

}



/*

It is used to get All Categories Data

*/
function getAllComments($postId)
{

  $tableComments=$GLOBALS['table_name_comments'];
  $query="SELECT * FROM $tableComments WHERE post_id='$postId' AND isEnable='0' ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  $comment=new Comment();	
  $data = [];
  $user=[];


  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {

  		$user=getRequiredUserInformation($row['user_id']);

  		if (count($user)<=0) {
  			continue;
  		}
	
    	array_push($data, [
      	'id'   => $row['id'],
      	'post_id' => $row['post_id'],
      	'user_id'   => $user[0]['id'],
      	'fName'   => $user[0]['fname'],
      	'lName'   => $user[0]['lname'],
      	'email'   => $user[0]['email'],
        'userType'   => $user[0]['userType'],
      	'avatar'   => $user[0]['avatar'],
      	'comments'   => $row['comments'],
      	'rating'   => $row['rating']       	
  		]);
   
    }
  	
  }
	

	return $data;

}



/*

It is used to get Top trending photos

*/
function getRequiredUserInformation($userId)
{

  $tableUser=$GLOBALS['table_name_user'];
  $query="SELECT * FROM $tableUser WHERE id='$userId' AND isEnable='0' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  $data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
      	'fname' => $row['fname'],
      	'lname' => $row['lname'],
        'userType' => $row['userType'],
      	'email'   => $row['email'],
      	'avatar' => $row['avatar']
      ]);
   
    }
  	
  }

	return $data;

}






/*

It is used to get Top trending photos

*/
function getPostComments($postId)
{

  $tableComments=$GLOBALS['table_name_comments'];
  $query="SELECT * FROM $tableComments WHERE post_id='$postId' AND isEnable='0' ";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
  /*$data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
      	'post_id' => $row['post_id']
      ]);
   
    }
  	
  }

  $totalComment=0;
  if (count($data)>0) {
  	# code...
  	$totalComment=

  }*/

	return $count;

}



/*

It is used to get Top trending photos

*/
function getPostRating($postId)
{

  $tableComments=$GLOBALS['table_name_comments'];
  $query="SELECT * FROM $tableComments WHERE post_id='$postId' AND isEnable='0' ";
  ///echo "$query";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
  $rating;
  $average=1.2;

  if ($count>0) {
  	
  	 while ($row = mysql_fetch_assoc($result)) {

  	 	$rating+=$row['rating'];


  	 }
	 
	 $average=$rating/count($row);	

  }

 

	return $average;

}



/*

It is used to get All Categories Data

*/
function login($email,$pass,$userType,$uid)
{

  $tableUser=$GLOBALS['table_name_user'];
  if ($userType=="native") {
    $query="SELECT * FROM $tableUser WHERE email='$email' AND password='$pass'";
  }else{
    $query="SELECT * FROM $tableUser WHERE email='$email' ";
  }
  
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result); 
  
  $user=new User(); 
  $data = [];

  if ($count>0) {

    // Loop through query and push results into $data;
    while ($row = mysql_fetch_assoc($result)) {
  
      array_push($data, [
        'id'   => $row['id'],
        'fname' => $row['fname'],
        'lname' => $row['lname'],
        'email'   => $row['email'],
        'password'   => $row['password'],
        'avatar' => $row['avatar'],
        'uid' => $row['uid'],
        'userType' => $row['userType'],
        'isEnable' => $row['isEnable']
      ]);
   
    }

     $user -> code="202";
     $user -> message="Data Retrieve Successfully";
     $user -> userId=$data[0]['id'];
     $user -> fName=$data[0]['fname'];
     $user -> lName=$data[0]['lname'];
     $user -> pass=$data[0]['password'];
     $user -> email=$data[0]['email'];
     $user -> avatar=$data[0]['avatar'];
     $user -> uid=$data[0]['uid'];
     $user -> userType=$data[0]['userType'];
     $user -> isEnable=$data[0]['isEnable'];
    
  }else{


    $user -> code="206";
    $user -> message="No data available";

  }
  

  $result = json_encode($user);
    echo "$result";

}



/*

It is used to get All Categories Data

*/
function register($email,$pass,$fName,$lName,$avatar,$userType,$uid)
{

  $tableUser=$GLOBALS['table_name_user'];

  if ($userType=="native") {
    $query="SELECT * FROM $tableUser WHERE email='$email'";
  }else{
    $query="SELECT * FROM $tableUser WHERE email='$email'";
  }

  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);

  //echo "$query";

  $user=new User();

  if ($count<=0) {

  if ($userType=="native") {
      $query = "INSERT INTO $tableUser (fname,lname,email,password,userType) VALUES ('$fName','$lName','$email','$pass','$userType')";
    }else {
      $query = "INSERT INTO $tableUser (fname,lname,email,userType,uid) VALUES ('$fName','$lName','$email','$userType','$uid')";
    } 

  
  $result=mysql_query($query);


    if (!$result) {
          # code...
        $isSuccess=false;
        //$message=mysql_error();

      }else{

        $isSuccess=true;

      }

        $data = [];

        if ($userType=="native") {

            

          if ($isSuccess) {
            # code...
            
            $pictureData = base64_decode($avatar);
            $userId=mysql_insert_id();
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/books4u/admin/uploads/image/'.$userId.'.png', $pictureData);
            $pictureName=mysql_insert_id().".png";
            $query_update= "UPDATE  $tableUser SET avatar='$pictureName' WHERE id='$userId' ";
            $result_update=mysql_query($query_update) OR die(mysql_error());
              $isPicture=true;
            

          }else{

             $isPicture=false;
            
          }


      }else{

      $userId=mysql_insert_id();
        $pictureName=$avatar;
        $query_update= "UPDATE  $tableUser SET avatar='$pictureName' WHERE id='$userId' ";
        $result_update=mysql_query($query_update) OR die(mysql_error());
          $isPicture=true;
      }

      if ($isPicture) {

        array_push($data, [
          'id'   => $userId,
          'first_name' => $fName,
          'last_name'   => $lName,
          'email' => $email,
          'password'   => $pass,
          'picture' => $pictureName,
          'userType' => $userType,
          'uid' => $uid,
          ]);

         $user -> code="202";
         $user -> message="Register Successfully";
         $user -> userId=$data[0]['id'];
         $user -> fName=$data[0]['first_name'];
         $user -> lName=$data[0]['last_name'];
         $user -> pass=$data[0]['password'];
         $user -> email=$data[0]['email'];
         $user -> avatar=$data[0]['picture'];
         $user -> uid=$data[0]['uid'];
         $user -> userType=$data[0]['userType'];
         

      }else{


      $user -> code="206";
        $user -> message="Problem while creating account";

      }

    }else{

        if ( $userType=="facebook" || $userType=="google" ) {
          login($email,$pass,$userType,$uid);
          return;
        }

        $user -> code="206";
        $user -> message="Account Already existed";

    }

    $result = json_encode($user);
      echo "$result";

}



/*

It is used to add Comment into Database

*/
function addComment($postId,$userId,$comment,$rating)
{

  $tableComment=$GLOBALS['table_name_comments'];
  $query="INSERT INTO $tableComment (post_id,user_id,comments,rating) VALUES ('$postId','$userId','$comment','$rating')";
  $result=mysql_query($query) OR die(mysql_error());
  	
	
  $comment=new Comment();	
  $data = [];

  if ($result) {


     $comment -> code="202";
     $comment -> message="Comment Added Successfully";
  	
  }else{


    $comment -> code="206";
    $comment -> message="Failed to add Comment";

  }
	

	$result = json_encode($comment);
    echo "$result";

}



/*

It is used to add Favourites into Database

*/
function addFavourites($postId,$userId)
{

  $tableFavourites=$GLOBALS['table_name_favourites'];
  $query="INSERT INTO $tableFavourites (post_id,user_id) VALUES ('$postId','$userId')";
  $result=mysql_query($query) OR die(mysql_error());
  	
	
  $favourites=new Favourites();	
  $data = [];

  if ($result) {


     $favourites -> code="202";
     $favourites -> message="Favourites Added Successfully";
  	
  }else{


    $favourites -> code="206";
    $favourites -> message="Failed to add into Favourites";

  }
	

	$result = json_encode($favourites);
    echo "$result";

}




/*

It is used to add Favourites into Database

*/
function deleteFavourites($id , $userId)
{

  $tableFavourites=$GLOBALS['table_name_favourites'];
  $query="DELETE FROM $tableFavourites WHERE post_id='$id' AND user_id='$userId' ";
  $result=mysql_query($query) OR die(mysql_error());
  	
	
  $favourites=new Favourites();	
  $data = [];

  if ($result) {


     $favourites -> code="202";
     $favourites -> message="Favourites Deleted Successfully";
  	
  }else{


    $favourites -> code="206";
    $favourites -> message="Failed to delete into Favourites";

  }
	

	$result = json_encode($favourites);
    echo "$result";

}




/*

It is used to get All Categories Data

*/
function getFavourites($userId)
{

  $tableFavourites=$GLOBALS['table_name_favourites'];
  $query="SELECT * FROM $tableFavourites WHERE user_id = '$userId'";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	

  //echo "$query";
	
  $favourites=new Favourites();	
  $data = [];


  //echo "$postType";

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {

  		//$info=[];
  		$info=getRequiredPostInformation($row['post_id']);

  		if (count($info)<=0) {
  			continue;
  		}
	
		/* if ($info==null) {
		 	continue;
		 }*/

    	array_push($data, [
      	'id'   => $row['id'],
      	'post_id'   => $info[0]['id'],
        'artist_id'   => $info[0]['artist_id'],
        'article_name'   => $info[0]['article_name'],
      	'cat_id' => $info[0]['cat_id'],
      	'title'   => $info[0]['title'],
      	'description' => $info[0]['description'],
        'tags' => $info[0]['tags'],
      	'postType'   => $info[0]['postType'],
      	'coverUrl'   => $info[0]['coverUrl'],
      	'originalUrl'   => $info[0]['originalUrl'],
      	'likes'   => $info[0]['likes'],
      	'dislikes'   => $info[0]['dislikes'],
      	'downloads'   => $info[0]['downloads'],
        'streamUrl'   => $info[0]['streamUrl'],
        'fbUrl'   => $info[0]['fbUrl'],
        'twitterUrl'   => $info[0]['twitterUrl'],
        'webUrl'   => $info[0]['webUrl'],
      	'comments'   => $info[0]['comments'],
      	'rating'  => $info[0]['rating'] 
          	
  		]);
   
    }

     $favourites -> favourites=$data;
     $favourites -> code="202";
     $favourites -> message="Data Retrieve Successfully";
  	
  }else{


    $favourites -> code="206";
    $favourites -> message="No data available";

  }
	

	$result = json_encode($favourites);
    echo "$result";

}



/*

It is used to get Privacy Policy

*/
function getPrivacyPolicy()
{

  $tablePrivacyPolicy=$GLOBALS['table_name_policy'];
  $query="SELECT * FROM $tablePrivacyPolicy";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	

  //echo "$query";
	
  $privacyPolicy=new PrivacyPolicy();	
  $data = [];


  //echo "$postType";

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {

    	array_push($data, [
      	'description'   => $row['description']
          	
  		]);
   
    }

     $privacyPolicy -> privacy=$data[0]['description'];
     $privacyPolicy -> code="202";
     $privacyPolicy -> message="Data Retrieve Successfully";
  	
  }else{


    $privacyPolicy -> code="206";
    $privacyPolicy -> message="No data available";

  }
	

	$result = json_encode($privacyPolicy);
    echo "$result";

}




/*

It is used to get All Categories Data

*/
function getRequiredPostInformation($userId)
{

  $tablePost=$GLOBALS['table_name_post'];
  $query="SELECT * FROM $tablePost WHERE id='$userId' AND isEnable='0' ORDER BY id DESC";
  $result=mysql_query($query) OR die(mysql_error());
  $count=mysql_num_rows($result);	
	
 

  /*if ($type=="image") {
  		
  		$postType="originalUrl";

  }elseif ($type=="video"){

  		$postType="videoUrl";

  }*/

   //echo "$postType";	
 

  $data = [];

  if ($count>0) {

  	// Loop through query and push results into $data;
  	while ($row = mysql_fetch_assoc($result)) {
	
    	array_push($data, [
      	'id'   => $row['id'],
        'artist_id'   => $row['artist_id'],
        'article_name'   => getArtistName($row['artist_id']),
      	'cat_id' => $row['cat_id'],
      	'title'   => $row['title'],
      	'description' => $row['description'],
        'tags' => $row['tags'],
      	'postType'   => $row['postType'],
      	'coverUrl'   => $row['coverUrl'],
      	'originalUrl'   => $row['originalUrl'],
      	'likes'   => $row['likes'],
      	'dislikes'   => $row['dislikes'],
      	'downloads'   => $row['downloads'],
        'streamUrl'   => $row['streamUrl'],
        'fbUrl'   => $row['fbUrl'],
        'twitterUrl'   => $row['twitterUrl'],
        'webUrl'   => $row['webUrl'],
      	'comments'   => getPostComments($row['id']),
      	'rating'  => getPostRating($row['id'])     	
  		]);
   
   		 }
  		
   }

 	 //var_dump($data);
	

	return $data;

}




/*

It is used to trigger forgot password

*/

function forgotPassword($email)
{

	$tableUser=$GLOBALS['table_name_user'];
	$query = "SELECT * FROM $tableUser WHERE email='$email' ";
	
	$result=mysql_query($query);
	$count=mysql_num_rows($result);

	$pass=null;
	$user=new User();

	while ($row = mysql_fetch_assoc($result)) {

	 $pass=$row['password'];

	}


		$to = $email; // this is your Email address
      	$from = "email@status4u.com"; // this is your Email address
        $headers = "From:" . $from;
        $subject="Forget Password";
        $message = "Your password is: ".$pass." ";
        mail($to,$subject,$message,$headers); 



	if ($pass!=null) {
		# code...
		//echo "Your password is emailed to you";
		$user -> code ="202";
		$user -> message ="Your password is emailed to you at ".$email;

	}else{

	   //echo "Sorry there is a problem.Kindly contact admin";
	    $user -> code ="206";
		$user -> message ="Sorry there is a problem.Kindly contact admin";

	}
	

	$result = json_encode($user);
	echo "$result";
	

}



/*

It is used to Update User Profile

*/

function updateProfile($id,$fName,$lName,$email,$pass,$picture)
{

	
	$tableUser=$GLOBALS['table_name_user'];
    $query_feature = "UPDATE $tableUser SET fname='$fName',lname='$lName',email='$email',password='$pass' WHERE id='$id'";
	$result_feature=mysql_query($query_feature) OR die(mysql_error());

	if (!$result_feature) {
		# code...
		$isSuccess=false;

	}else{

		$isSuccess=true;

	}

    	

	$user=new User();
	$isSuccess;
	$data = [];

	if ($isSuccess) {
		# scode...

		$userId=$id;
		$pictureName=$id.".png";

		if (!($picture=="null")) {
			# code...

		$pictureData = base64_decode($picture);	
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/books4u/admin/uploads/image/'.$userId.'.png', $pictureData);
		

		}

		 $isPicture=true;
		

	}else{

		$isPicture=false;
		
	}

	 if (!$isSuccess || !$isPicture ) {
  	# code...
	  	 $user -> code="206";
	     $user -> message="Problem while updating profile";
	 

   }else{

   	 $user -> userId = $userId;
      $user -> fName = $fName;
      $user -> lName = $lName;
      $user -> email = $email;
      $user -> pass = $pass;
      $user -> avatar = $pictureName;
	  $user -> code="202";
	  $user -> message="Data updated Successfully";

   }

 

  $user_result = json_encode($user);
  echo "$user_result";

}


/*

It is used to add Report to book

*/
function addReport($userId,$postId,$report)
{

  $tableReport=$GLOBALS['table_name_report'];
  $query="INSERT INTO $tableReport (post_id,user_id,report) VALUES ('$postId','$userId','$report')";
  $result=mysql_query($query) OR die(mysql_error());

}



?>