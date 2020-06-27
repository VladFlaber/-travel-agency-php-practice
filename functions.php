<?php 

function refreshPage()
{
	echo "<script>";
				echo "window.location=document.URL;";
				echo "</script>";
}
function getId($cbname){

}
function connect(
$host='localhost',
$user='root',
$dbname='Travels2')
{
$link=mysqli_connect($host,$user,$pass) or
die('connection error');
mysqli_select_db($link,$dbname) or die('DB open
error');
mysqli_query($link,"set names 'utf8'");
return $link;
}


function kav($val){

	return "'".$val."'";
}
function registration($login , $psw, $pswCheck,$email,$file){
	if(!$login_exists){
		$sql="INSERT INTO `users` ( `login`, `psw`, `email`,`avatar`) VALUES(".kav($login).','.kav($psw).','.kav($email).','.kav($file).');';
		
		if(mysqli_query(connect(), $sql)){
  		    echo "запись добавлена";
  		    return 1;
		}
	 	else{
   		 echo "ERROR: Could not able to execute $sql. " . mysqli_error(connect());
   		 return -1;
		}

	}
	else{
		return 0;
	}

}
function login_exists($login){	
	$link = connect();
	$sql='select * from users where login='.kav($login);
	$res= mysqli_query($link,$sql);
    return mysqli_num_rows($res)>0;
}
///returns users id
function login($login , $psw){

	if(!(strlen($login)>0)&&!(strlen($psw)>0)){
		return null;
	}
	else {
		$link=connect();
		$sql="SELECT * from users where login=".kav($login)."and psw=".kav($psw);
		$exec = mysqli_query($link,$sql);
			$sql;
			$user=mysqli_fetch_row($exec);
			if(isset($user)){
			echo mysqli_error($link);
			echo "ya tyt";
		 
			return $user;
			}
			else {
			echo "введен не верный логин или пароль";
			return null;
			}
	}
}
function getUserById($id){
	$link=connect();

}
function getCountries(){
	$resource=mysqli_query(connect(), 'SELECT * FROM countries');
	
	return $resource;
}
function getCities(){
		$query =  "SELECT CI.Id,CI.city,CI.ucity, C.country 
		FROM cities CI join countries as C on C.Id=CI.CountryId";			
		$resource=mysqli_query(connect(), $query);
		return $resource;
	
}
function getCitiesByCountryId($id){
	$query =  "SELECT CI.Id,CI.city,CI.ucity, C.country 
		FROM cities CI join countries as C on C.Id=CI.CountryId WHERE CI.countryId=".$id;			
		$resource=mysqli_query(connect(), $query);
		return $resource;
}
function getHotels(){
	$res=mysqli_query(connect(),"SELECT H.Id,CI.ucity , H.hotel, H.stars,H.cost
    FROM Hotels H 
	join cities CI on CI.Id=H.cityId ");

	return $res;
}
function getHotelsByCityId($id){
	$link=connect();
	$sql="SELECT H.id,CI.ucity , H.hotel, H.stars,H.cost,CI.Id
    FROM Hotels H 
	join cities CI on CI.Id=H.cityId WHERE H.cityid=".$id;
	$res=mysqli_query($link,$sql);
	echo $sql;
	echo mysqli_error($link);
	return $res;
}
function getHotelWithImagesById($id){
	$link=connect();
	$sql="SELECT H.id, H.hotel, H.stars,H.cost,H.info
    FROM Hotels H 
	WHERE H.id=".$id;
	$res=mysqli_query($link,$sql);
	echo $sql;
	echo mysqli_error($link);
	return $res;
}
function getImagesByHotelId($id){
	$link=connect();
	$sql = "SELECT I.ImagePath from images I where I.HotelId=".$id;
	$res=mysqli_query($link,$sql);
	echo $sql;
	
	echo mysqli_error($link);
	return $res;
}
function getUsers(){
	$resource=mysqli_query(connect(), 'SELECT * FROM users');
	echo mysqli_error(connect());
	return $resource;
}
function addCountry($country){	
	
	if(!mysqli_query(connect(),'INSERT INTO `countries` (`country`) VALUES ('.kav($country).');'))
	{
		echo "dobavleno";
	}
	else
		echo 'error : '.mysqli_errno(connect());
}

function addCity($city , $countryId){
	$link=connect();
	$ucity=$city;
	$res=mysqli_query($link,'SELECT country From countries C WHERE C.Id='.$countryId);
	while ($row=mysqli_fetch_array($res))
	$str=$row[0];
	$ucity.=":".$str;

	if(!mysqli_query($link,'INSERT INTO `cities` (`city`,`countryId`,`ucity`) VALUES ('.kav($city).','.kav($countryId).','.kav($ucity).');')) 
		echo 'error : '.mysqli_errno(connect());
	
	
		
}

function addHotel($hotel,$cityId,$stars,$cost,$descirption){
	$link=connect(); 
	$sql = 'INSERT INTO `Hotels` (`Hotel`,`cityId`,`stars`,`cost`,`info`) 
	VALUES ('.kav($hotel).','.kav($cityId).','.kav($stars).','.kav($cost).','.kav($descirption).');';
	if(!mysqli_query($link,$sql)){
		echo 'error : '.mysqli_errno(connect());
	}
	else 
		echo "OKSADOKASOKDo";
	
}

function addImageToHotel($hotelId,$upladed){
	if(!mysqli_query(connect(),'INSERT into `images` (`hotelId`,`ImagePath`) values ('.kav($hotelId).','.kav($upladed).'); ')) {
		echo 'error : '.mysqli_errno(connect());
	}
	else
		echo 'ok';
}






function createDB(){
	$script='create table countries(
id int not null auto_increment primary key,
country varchar(64) unique
);
create table cities(
id int not null auto_increment primary key,
city varchar(60),
CountryId int,
ucity varchar (50)    
);
CREATE table hotels(
id int not null auto_increment primary key,
hotel varchar (60),

cityId int ,
   stars int ,
    cost decimal,
    info varchar(300)
);
CREATE TABLE users(
id int not null auto_increment primary key,
login varchar(20) UNIQUE,
psw varchar(20),
email varchar (20),
role int DEFAULT 0,
discount int DEFAULT 0,
avatar blob 
);

CREATE table images(
id int not null auto_increment primary key,
HotelId int,
ImagePath varchar(64)
);

ALTER TABLE cities ADD CONSTRAINT fk_cntry_id FOREIGN KEY (countryId) REFERENCES countries(id) ON DELETE CASCADE;

ALTER TABLE hotels ADD CONSTRAINT fk_city_id FOREIGN KEY (cityId) REFERENCES cities(id) ON DELETE CASCADE;

ALTER TABLE images ADD CONSTRAINT fk_hotel_id FOREIGN KEY (HotelId) REFERENCES hotels(id) ON DELETE CASCADE;
';
	mysqli_select_db(connect(),'Travels');
	mysqli_query(connect(),$script);
	$err=mysqli_errno(connect());
	if ($err){
	echo 'Error code 6:'.$err.'<br>';
	exit();
	}

}