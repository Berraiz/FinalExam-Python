<!DOCTYPE html>
<html>
<head>
    <title>Digital Party Planner</title>
</head>
<body>
    <h1>Plan Your Party!</h1>

    <form method="post">
        <p>Select items (hold Ctrl/Cmd to select multiple):</p>
        <select name="items[]" multiple size="10">
            <option value="0">Cake</option>
            <option value="1">Balloons</option>
            <option value="2">Music System</option>
            <option value="3">Lights</option>
            <option value="4">Catering Service</option>
            <option value="5">DJ</option>
            <option value="6">Photo Booth</option>
            <option value="7">Tables</option>
            <option value="8">Chairs</option>
            <option value="9">Drinks</option>
            <option value="10">Party Hats</option>
            <option value="11">Streamers</option>
            <option value="12">Invitation Cards</option>
            <option value="13">Party Games</option>
            <option value="14">Cleaning Service</option>
        </select>
        <br><br>
        <input type="submit" value="Submit">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["items"])) {
    $indices = $_POST["items"]; 
    $input = implode(",", $indices); 


    $cmd = "python3 /var/www/html/party_planner.py";

    $descriptorspec = [
        0 => ["pipe", "r"], 
        1 => ["pipe", "w"], 
        2 => ["pipe", "w"]  
    ];

    $process = proc_open($cmd, $descriptorspec, $pipes);

    if (is_resource($process)) {
        fwrite($pipes[0], $input);
        fclose($pipes[0]);

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        $return_value = proc_close($process);

        echo "<hr><div>$output</div>";

        if ($error) {
            echo "<pre style='color:red;'>$error</pre>";
        }
    } else {
        echo "<p>Error running Python script.</p>";
    }
}
?>
</body>
</html>
