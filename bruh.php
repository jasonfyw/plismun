<!DOCTYPE html>
<html>
    <body>



        <?php 

        $rows = 4;

        echo "<table>";
        for ($y = 1; $y < $rows + 1; $y++) {

            echo '<tr>';
            for ($x = 1; $x < 9; $x++) {

                $is_row_even = $y % 2; 

                $colour = ($x % 2 == $is_row_even) ? 'grey' : 'white';
                echo "<td bgcolor='{$colour}'>r{$y} c{$x}</td>";

            }
            echo '</tr>';

        }
        echo "</table>";

        ?>

        <!-- 1 | 1, 2, 3, 4, 5, ...
        2 | 1, 2, 3, 4, 5, ...
        3 | 1, 2, 3, 4, 5, ...
        4 | 1, 2, 3, 4, 5, ... -->

        <!-- $y % 2 = 0 or 1 -->



    </body>
</html>