<?php
class Adventcode {
/*
 * WARNING! Do not use this on live server! I didn't use security measers!
 */
    
public static $directions = array(), $houses = array(),  $coordinate = array(), $start = 0;
        
   public static function calculateHouses($a){// this function sets starting values in arrays
       self::$directions = str_split ($a); //splits string into array of characters
       self::$houses["0,0"] = 1; //fills associative array with starting coordinate
       self::$coordinate[0] = 0; //fills temporary array wich will later change depending on input from set of string coordinates
       self::$coordinate[1] = 0;
       
       //echo "<pre>".var_dump(Adventcode::$coordinate)."</pre>coordinates</br>";
       //echo "<pre>".var_dump(Adventcode::$directions)."</pre>directions</br>";
       //echo "<pre>".var_dump(Adventcode::$houses)."</pre>houses</br>";
       
   }



}

function callbackCalculate($value, $key){
   /*
    * according to set of characters given, this callback function uses each character
    * from array  $directions and adds or subtracts from starting coordinate in 
    * array $coordinate, then through the variable $coor checks if that kind of 
    * coordinate exists as key value in array $houses. If that coordinate exists
    * in array, adds 1 to value but if coordinate doesn't exists, creates new 
    * coordinate with value 1 and adds it to the end of array $houses.
    * At the end of the process, all coordinates in array $houses represents
    * houses that are visited at least once.
    */                                     
    
    switch ($value) {
    case '<':
        Adventcode::$coordinate[0] -= 1;
        break;
    case '>':
        Adventcode::$coordinate[0] += 1;
        break;
    case 'v':
        Adventcode::$coordinate[1] -= 1;
        break;
    case '^':
        Adventcode::$coordinate[1] += 1;
        break;
    default :
        return;
    } 
    $coor = Adventcode::$coordinate[0].','.Adventcode::$coordinate[1];
    if(array_key_exists($coor, Adventcode::$houses)){
        Adventcode::$houses[$coor] += 1;
    }else {
        Adventcode::$houses[$coor] = 1;
    }
    
    
    
}

if ($_POST['firstWord'] != ''){
    Adventcode::calculateHouses($_POST['firstWord']);
    array_walk(Adventcode::$directions, "callbackCalculate");
    echo 'Number of visited houses: '.count(Adventcode::$houses)."</br>";
    
}
?>

<form action="adventcode.php" method="post">
		  <table>
                      <thead>ADVENTCODE</thead>
		    <tr>
		      <td>Coordinates:</td>
		      <td>
                          <input type="text" name="firstWord" />
		      </td>
		    </tr>
                    <tr>
		    <td colspan="2">
		        <input type="submit" name="submit" value="Submit" />
		      </td>
		    </tr>
		  </table>
		</form>
