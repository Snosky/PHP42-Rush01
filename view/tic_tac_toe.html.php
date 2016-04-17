<main>
    <h1>It's <span id="whosturn"><?php echo $tictactoe->turn;?></span>'s turn.</h1>
    <table id="board">
        <tr>
            <td id="0"><?php
                if (isset($tictactoe->$map[0])){
                    if ($tictactoe->$map[0] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?>
            </td>
            <td id="1">
                <?php
                if (isset($tictactoe->$map[1])){
                    if ($tictactoe->$map[1] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?>
            </td>
            <td id="2"><?php
                if (isset($tictactoe->$map[2])){
                    if ($tictactoe->$map[2] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
        </tr>
        <tr>
            <td id="3"><?php
                if (isset($tictactoe->$map[3])){
                    if ($tictactoe->$map[3] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="4"><?php
                if (isset($tictactoe->$map[4])){
                    if ($tictactoe->$map[4] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="5"><?php
                if (isset($tictactoe->$map[5])){
                    if ($tictactoe->$map[5] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
        </tr>
        <tr>
            <td id="6"><?php
                if (isset($tictactoe->$map[6])){
                    if ($tictactoe->$map[6] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="7"><?php
                if (isset($tictactoe->$map[7])){
                    if ($tictactoe->$map[7] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="8"><?php
                if (isset($tictactoe->$map[8])){
                    if ($tictactoe->$map[8] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
        </tr>
    </table>
</main>
<script>
    
</script>