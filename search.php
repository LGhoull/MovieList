<!DOCTYPE html>
<html>
<head>
	<title>MovieList.de</title>
	
    <style>

    body {
        background-color: #f2f2f2;
    }

    #header {
    display: flex;
    justify-content: space-between;
    padding: 30px 30px 20px 30px;
    background-color: #333;
    border-radius: 6px;
    color: white;
        }

    #logo {
        display: flex;
        font-size: 30px;
        font-family: 'Gill Sans', 'Gill Sans MT';
        margin-right: auto;
        padding-left: 20px;
        color: wheat;
    }

    #header button {
        background-color: #6666ff;
        color: white;
        border: none;
        padding: 10px;
        font-family: 'Gill Sans', 'Gill Sans MT';
        font-size: 20px;
        margin-left: 10px;
        border-radius: 6px;
        align-items: center;
        margin-top: auto;
        cursor: pointer;
    }

    #search {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
        font-size: 20px;
        margin-top: 50px;
    }

    #search input[type="text"] {
        width: 50%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-family: 'Gill Sans', 'Gill Sans MT';
        font-size: 20px;
        box-shadow: 0px 0px 5px grey;
        font-size: 16px;
        outline: none;
    }

    #search button {
        background-color: #6666ff;
        color: white;
        border: none;
        padding: 10px;
        font-family: 'Gill Sans', 'Gill Sans MT';
        border-radius: 6px;
        font-size: 20px;
        margin-left: 10px;
        cursor: pointer;
    }
	</style>
</head>
<body>
	<div id="header">
		<span id="logo">MovieList.de</span>
        <button>Abmelden</button>
        <button>Meine Liste</button>
	</div>
	<div id="search">
		<input type="text" placeholder="Suche...">
		<button>Suchen</button>
	</div>
</body>
</html>