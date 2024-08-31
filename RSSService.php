<?php

class RSSService
{
    public static function ParseXml($rss){
        $words = explode( ' ', $rss);
        $cont=0;
        $items = [];
        $temparr = [];
        echo "is it?";
        $filtered = array_values(array_filter($words));
        var_dump($filtered[23]);
        for ($i = 1; $i<count($filtered); $i++) {
            var_dump($i);
            var_dump($filtered[$i]);
            if($filtered[23] == "<channel>\n"){
                echo "xxxx";

            }
            if ($filtered[$i - 1] == "<item>\n") {
                $cont++;
                echo "anything";
                $temparr = [];
            }
            if($cont != 0 && $filtered[$i] != "</item>\n" && $filtered[$i] != "<item>\n") {
                $temparr [] = $filtered[$i];

            }elseif ($filtered[$i] == "</item>\n"){
                $items[] = $temparr;

            }

        }
        return $items;
    }

    public static function getAttributes($items){
        $title="";
        $description="";
        $link="";
        $image="";
        $attributes = [];
        for ($i = 0; $i<=count($items)-1 ; $i++) {
            for ($j = 0; $j<=count($items[$i])-1 ; $j++) {
                if(stripos($items[$i][$j], "<title>")!==false){
                    $stop=0;
                    echo "title";
                    while ($stop===0 && $j<count($items[$i])){
                        if(stripos($items[$i][$j], "</title>")!==false){
                            $stop=1;
                        }
                        $title.=(stripos($items[$i][$j], "<title>")!==false)? substr($items[$i][$j], 7).'&nbsp' :
                            ((stripos($items[$i][$j], "</title>")!==false)? substr($items[$i][$j],0,stripos($items[$i][$j], "</title>")) :$items[$i][$j].'&nbsp') ;
                        $j++;

                   }
                   $attributes[$i][0]=$title;
                    $title="";

                }
                if(stripos($items[$i][$j], "<description>")!==false){
                    $stop=0;
                    echo "description";
                    while ($stop===0 && $j<count($items[$i])){
                        if(stripos($items[$i][$j], "</description>")!==false){
                            $stop=1;
                        }
                        $description.=(stripos($items[$i][$j], "<description>")!==false)? substr($items[$i][$j], 13).'&nbsp' :
                            ((stripos($items[$i][$j], "</description>")!==false)? substr($items[$i][$j],0,stripos($items[$i][$j], "</description>")) :$items[$i][$j].'&nbsp') ;
                        $j++;

                    }
                    $attributes[$i][1]=$description;
                    $description="";

                }

                if(stripos($items[$i][$j], "<link>")!==false){
                    $link=substr($items[$i][$j],6,stripos($items[$i][$j],"</link>")-6);
                    $attributes[$i][2]=$link;
                    $link="";



                }

                if(stripos($items[$i][$j], "<media:content")!==false){
                    $stop=0;
                    while ($stop===0 && $j<count($items[$i])){
                        if(stripos($items[$i][$j], "url=")!==false){
                            $stop=1;
                            $image=substr($items[$i][$j],5,strlen($items[$i][$j])-6);

                        }

                        $j++;

                    }
                    $attributes[$i][3]=$image;
                    $image="";



                }



            }
        }


        return $attributes;
    }


    public static function PopulateHTML($array){
        foreach ($array as $item){
           echo '<div class="col-9 row my-2">';
           echo  '<div class="col-4 my-1">';
           echo '<img src="'.$item[3].'"'.'alt="Image" class="img-fluid">';
           echo '</div>';
           echo '<div class="col-8 my-2">';
           echo '<h4 class="text-break">'.$item[0].'</h4>';
           echo  '<p class="text-break">'.$item[1].'</p>';
           echo  '<a class="text-break" href="'.$item[2].'">'.$item[2].'</a>';
           echo             '</div>';
           echo        '</div>';

        }

    }


}