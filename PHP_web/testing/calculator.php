<?php


function calculate($a, $b, $op) {
    switch ($op) {
        case 'plus':
            return ["add", $a + $b];

        case 'minus':
            return ["subtract", $a - $b];

        case 'multiply':
            return ["multiply", $a * $b];

        case 'divide':
            if ($b == 0) {
                throw new Exception("Division by zero is not allowed");
            }
            return ["divide", $a / $b];

        case 'modulo':
            if ($b == 0) {
                throw new Exception("Modulo by zero is not allowed");
            }
            return ["modulo", $a % $b];

        default:
            throw new Exception("Unknown operation");
    }
}

// --- FORM HANDLING ---------------------------------------------------------

$error = "";
$result = "";
$operation = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $a = $_POST["numberone"] ?? "";
    $b = $_POST["numbertwo"] ?? "";
    $op = $_POST["operation"] ?? "";

    if (!is_numeric($a) || !is_numeric($b)) {
        $error = "Both inputs must be numbers";
    } else {
        try {
            list($operation, $result) = calculate($a, $b, $op);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>

<h1>Calculator</h1>

<form method="post">

    <label>Number 1</label>
    <input type="text" name="numberone" value="<?= htmlspecialchars($_POST['numberone'] ?? '') ?>">

    <br><br>

    <label>Number 2</label>
    <input type="text" name="numbertwo" value="<?= htmlspecialchars($_POST['numbertwo'] ?? '') ?>">

    <br><br>

    <button type="submit" name="operation" value="plus">Add</button>
    <button type="submit" name="operation" value="minus">Subtract</button>
    <button type="submit" name="operation" value="multiply">Multiply</button>
    <button type="submit" name="operation" value="divide">Divide</button>
    <button type="submit" name="operation" value="modulo">Modulo</button>

</form>

<br>

<?php if ($error): ?>
    <strong style="color:red;"><?= $error ?></strong>
<?php elseif ($result !== ""): ?>
    <strong>Operation:</strong> <?= $operation ?><br>
    <strong>Result:</strong> <?= $result ?>
<?php endif; ?>

</body>
</html>