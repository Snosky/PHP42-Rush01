<main>
    <h1>It's <span id="whosturn"><?php echo $game[$id]->turn;?></span>'s turn.</h1>
    <table id="board">
        <tr>
            <td id="0"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[0] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?>
            </td>
            <td id="1">
                <?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[1] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?>
            </td>
            <td id="2"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[2] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
        </tr>
        <tr>
            <td id="3"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[3] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="4"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[4] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="5"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[5] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
        </tr>
        <tr>
            <td id="6"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[6] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="7"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[7] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
            <td id="8"><?php
                if (isset($game[$id])){
                    if ($game[$id]->$map[8] == 'x')
                        echo ("x");
                    else
                        echo ('o');
                }?></td>
        </tr>
    </table>
</main>