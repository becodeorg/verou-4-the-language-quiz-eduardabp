<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Game</title>
	<link rel=stylesheet href="style.css">
</head>
<body>
	<h1>Language Quiz</h1>
	<h2>Translate this Dutch word to English.</h2>
    <p>Dutch: <strong><?= $_SESSION["Word"]->getDutchTranslation()?></strong></p>
    <form method="POST">
        <label for="english-translation">English:</label>
        <input id="english-translation" name="player-input">
		<br><br>
        <button type="submit">Verify your answer</button>
		<button type="submit" name="reset">Reset your score</button>
    </form>
</body>
</html>