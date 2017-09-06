<?php
session_start();
$FLAG = ['flag{1_4m_7h3_g0d_', '0f_cr@f75m4n5h1p}'];
$RESOURCE_ITEMS = ['wool', 'stick', 'dye', 'bricks'];
$CRAFT_ITEMS = ['painting', 'dyed_field_masoned_banner'];

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [];

    foreach (array_merge($RESOURCE_ITEMS, $CRAFT_ITEMS) as $item) {
        $_SESSION['inventory'][$item] = [];
    }
}

$count = [];

foreach (array_merge($RESOURCE_ITEMS, $CRAFT_ITEMS) as $item) {
    $count[$item] = count($_SESSION['inventory'][$item]);
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if (strcasecmp($action, "walk") == 0) {
        $found_item = array_rand(array_slice($RESOURCE_ITEMS, 0, 2));
        $message = "You found some " . $RESOURCE_ITEMS[$found_item] . " up ahead.";
    } elseif (strcasecmp($action, "craft") == 0) {
        if (isset($_POST['item']) and in_array($_POST['item'], $CRAFT_ITEMS)) {
            $crafted_item = $_POST['item'];
            $crafted_item_name = ucwords(str_replace("_", " ", $crafted_item));

            if ($crafted_item == $CRAFT_ITEMS[0] && $count['wool'] >= 1 && $count['stick'] >= 6) {
                for ($i = 0; $i < 6; $i++) {
                    unset($_SESSION['inventory']['stick'][--$count['stick']]);
                }

                unset($_SESSION['inventory']['wool'][--$count['wool']]);

                $_SESSION['inventory'][$crafted_item][] = $count[$crafted_item]++;
                $message = "You crafted a " . $crafted_item_name . ".";
            } else if ($crafted_item == $CRAFT_ITEMS[1] && $count['wool'] >= 6
                    && $count['stick'] >= 1 && $count['dye'] >= 1 && $count['bricks'] >= 1) {
                for ($i = 0; $i < 6; $i++) {
                    unset($_SESSION['inventory']['wool'][--$count['wool']]);
                }

                unset($_SESSION['inventory']['stick'][--$count['stick']]);
                unset($_SESSION['inventory']['dye'][--$count['dye']]);
                unset($_SESSION['inventory']['bricks'][--$count['bricks']]);

                $_SESSION['inventory'][$crafted_item][] = $count[$crafted_item]++;
                $message = "You crafted a " . $crafted_item_name . ".";
            } else {
                $message = "You do not have enough resources to craft ". $crafted_item_name . ".";
            }
        } else {
            $message = "Invalid item.";
        }
    } elseif (strcasecmp($action, "view_flag") == 0) {
        $message = "";

        if ($count[$CRAFT_ITEMS[0]] >= 1) {
            $message .= $FLAG[0];
        }

        if ($count[$CRAFT_ITEMS[1]] >= 1) {
            $message .= $FLAG[1];
        }

        if (empty($message)) {
            $message = "You have no flags.";
        }
    } else {
        $message = "Invalid action.";
    }
}

if (isset($_GET['item'])) {
    $collected_item = $_GET['item'];

    if (in_array($collected_item, $RESOURCE_ITEMS)) {
        $_SESSION['inventory'][$collected_item][] = $count[$collected_item]++;
        $message = "You collected a " . $collected_item . ".";
    } else {
        $message = "Invalid item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>CTF101 | WebCraft (Compact)</title>
    <link rel="stylesheet" rev="stylesheet" href="./css/style.css" type="text/css">
</head>
<body>
<div class="navbar">
    <a href="#">CTF101 2017</a>
</div>
<div class="centered-wrapper">
<div class="centered-content">
    <h3>WebCraft (Compact)</h3>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
    <form id="action_form" novalidate="novalidate" action="index.php" accept-charset="UTF-8" method="post">
        <button name="action" type="submit" value="walk">Walk</button>

    <?php if (isset($found_item)): ?>
        <a action="" data-method="get" href="?item=<?php echo $RESOURCE_ITEMS[$found_item]; ?>"><button type="button">Collect</button></a>
    <?php endif; ?>
    <br/>
    <br/>
        <select name="item">
            <option value="painting">Painting</option>
            <option value="dyed_field_masoned_banner">Dyed Field Masoned Banner</option>
        </select>
        <button name="action" type="submit" value="craft">Craft</button>
    <?php if ($count[$CRAFT_ITEMS[0]] >= 1 || $count[$CRAFT_ITEMS[1]] >= 1): ?>
        <button name="action" type="submit" value="view_flag">View Flag</button>
    <?php endif; ?>
    </form>

    <div id="wrapper">
        <div id="left">
            <h4>Crafting Recipe</h4>
            Painting<br/>
            <input type="checkbox" <?php if ($count['wool'] >= 1) echo 'checked'; ?> onclick="return false;">Wool x1<br/>
            <input type="checkbox" <?php if ($count['stick'] >= 6) echo 'checked'; ?> onclick="return false;">Stick x6<br/>
            <br/>
            Dyed Field Masoned Banner<br/>
            <input type="checkbox" <?php if ($count['wool'] >= 6) echo 'checked'; ?> onclick="return false;">Wool x6<br/>
            <input type="checkbox" <?php if ($count['stick'] >= 1) echo 'checked'; ?> onclick="return false;">Stick x1<br/>
            <input type="checkbox" <?php if ($count['dye'] >= 1) echo 'checked'; ?> onclick="return false;">Dye x1<br/>
            <input type="checkbox" <?php if ($count['bricks'] >= 1) echo 'checked'; ?> onclick="return false;">Bricks x1
        </div>
        <div id="right">
            <h4>Inventory</h4>
            <select multiple size="14" style="overflow:auto;width:250px">
        <?php foreach ($count as $item => $e): ?>
            <?php if ($count[$item] > 0): ?>
                <option><?php echo ucwords(str_replace("_", " ", $item)); ?> x<?php echo $count[$item]; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
            </select>
        </div>
        <div id="cleared"></div>
    </div>
</div>
</div>
</body>
</html>