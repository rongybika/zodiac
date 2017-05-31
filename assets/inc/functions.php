<?php
//function for generate the date range
function dateRange( $first, $last, $step = '+1 day', $format = 'm/d/Y' ) {

    $dates = array();
    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        //$dates[] = date( $format, $current );
        $dates[] = explode("/", date( $format, $current ));
        $current = strtotime( $step, $current );
    }

    return $dates;
}
function getMonthNames($month)
{
    if ($month < 1 || $month > 12) {
        return;
    }
    //get language from the browser and set up the months in local language
    $sLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    //echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $sLang = str_replace("-","_",$sLang);
    $sLang = $sLang.".UTF8";
    setlocale(LC_ALL, $sLang);

    $sFirstMonth = strftime("%B",mktime(0, 0, 0, $month, 1, 1));
    $next_month = $month < 12 ? $month + 1 : 1;
    $sSecondMonth = strftime("%B",mktime(0, 0, 0, $next_month, 1, 1));
    return array(
        ucfirst($sFirstMonth),
        ucfirst($sSecondMonth)
    );

}

function displayMonth($iZodiacDay, $aZodiacMonth)
{
    $iZodiacDay=$iZodiacDay - 1;
    //getMonthName($aZodiacMonth[0][0]);
    list($sFirstMonth, $sSecondMonth) = getMonthNames($aZodiacMonth[0][0]);
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>';
    echo '</td>';
    //step how change the transparency of the heart image
    $iStep = 1 / count($aZodiacMonth);
    //step how to change size of the heart image
    $iImageSize = 20 / count($aZodiacMonth);
    //show the heart image with specific transparency and size depending on percent of compatibility
    for ($i = 0; $i < count($aZodiacMonth); $i++) {
        echo '<td>';
        if ($i == $iZodiacDay) {
            echo '<img class ="heart" src="./images/heart.png" alt="heart" height="40" width="40" style="opacity:' . (1 - ((abs($iZodiacDay - $i)) * $iStep)) . ';">';
        };
        if ($i != $iZodiacDay) {
            echo '<img src="./images/heart.png" alt="heart" height="' . (20 - ((abs($iZodiacDay - $i)) * $iImageSize)) . '" width="' . (20 - ((abs($iZodiacDay - $i)) * $iImageSize)) . '" style="opacity:' . (1 - ((abs($iZodiacDay - $i)) * $iStep)) . ';">';
        };
        echo '</td>';
    }
    echo '<td>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="tdRight">';
    echo $sFirstMonth;
    echo '</td>';
    //showing love compatible zodiac date range
    for ($i = 0; $i < count($aZodiacMonth); $i++) {
        echo '<td class="align">';
        echo $aZodiacMonth[$i][1];
        echo '</td>';
    }
    echo '<td class="tdLeft">';
    echo $sSecondMonth;
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}

function checkZodiacFromDate($dBirthdate)
{
    global $aZodiacDates, $xml;
    $sZodiac = "";
    echo '<span class="bigText">They are compatible with you:</span>';
    
    list ($iBirthYear, $iBirthMonth, $iBirthDay) = explode("-", $dBirthdate);

    //reading zodiac ranges from dates.xml and generate the zodiac dates range
    $xml=simplexml_load_file("dates/dates.xml") or die("Error: Cannot create object");
    for ($i = 1; $i <= 12; $i++) {
        $sFirstMonth = (string)$xml->zodiacdates[$i]->firstMonth[0];
        $sFirstDay = (string)$xml->zodiacdates[$i]->firstDay[0];
        $sLastMonth = (string)$xml->zodiacdates[$i]->lastMonth[0];
        $sLastDay = (string)$xml->zodiacdates[$i]->lastDay[0];
        $sFirstZodiacDate = $sFirstMonth . '/' . $sFirstDay . '/' . $iBirthYear;
        if (intval($sFirstMonth) < 12) {
            $sLastZodiacDate = $sLastMonth . '/' . $sLastDay . '/' . $iBirthYear;
        } else {
            $sLastZodiacDate = $sLastMonth . '/' . $sLastDay . '/' . ($iBirthYear + 1);
        }
        $aZodiacDates[$i] = dateRange($sFirstZodiacDate, $sLastZodiacDate);
        }
    for ($i = 1; $i <= 12; $i++) {
        $sFirstMonth = (string)$xml->zodiacdates[$i]->firstMonth[0];
        $sFirstDay = (string)$xml->zodiacdates[$i]->firstDay[0];
        $sLastMonth = (string)$xml->zodiacdates[$i]->lastMonth[0];
        $sLastDay = (string)$xml->zodiacdates[$i]->lastDay[0];

        //check wich zodiac is love compatible with the date from input field
        if (($iBirthMonth == intval($sFirstMonth) && $iBirthDay > (intval($sFirstDay) - 1)) || ($iBirthMonth == intval($sLastMonth) && $iBirthDay < intval($sLastDay))) {
            for ($ii = 0; $ii < count($aZodiacDates[$i]); $ii++) {
                if (intval($aZodiacDates[$i][$ii][1]) == $iBirthDay) {
                    foreach ($xml->zodiacdates[$i]->compatible_id as $x => $sCompatibleValue) {
                        echo '<span class="zodImg">&#' . $xml->zodiacdates[intval($sCompatibleValue)]->image . '</span>';
                        echo "<br>";
                        echo $xml->zodiacdates[intval($sCompatibleValue)]->zodiac;
                        echo "<br>";
                        displayMonth($ii, $aZodiacDates[intval($sCompatibleValue)]);
                    }
                }
            }
        }
    }
}