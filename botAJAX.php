<?php

/* Establishes a connection with the database. The first argument is the server name, the second is the username for the database, the third is the password (blank for me) and the final is the database name
*/
$conn = mysqli_connect("localhost","root","","bot-chat");

// If the connection is established successfully
if($conn)
{
    // Get the user's message from the request object and escape characters
    $user_messages = mysqli_real_escape_string($conn, $_POST['messageValue']);

    // create SQL query for retrieving the corresponding reply
    $query = "SELECT * FROM botmessage WHERE messages LIKE '%$user_messages%'";

    // Execute query on the connected database using the SQL query
    $makeQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($makeQuery) > 0)
    {

        // Get the result
        $result = mysqli_fetch_assoc($makeQuery);

        // Echo only the response column
        echo $result['response'];
    }else{

        // Otherwise, echo this message
        echo "Sorry, I can't understand you.";
    }
}else {

    // If the connection fails to establish, echo an error message
    echo "Connection failed" . mysqli_connect_errno();
}
?>
<script type="text/javascript">

    // When send button gets clicked
    document.querySelector("#send").addEventListener("click", async () => {

        // create new request object. get user message
        let xhr = new XMLHttpRequest();
        var userMessage = document.querySelector("#userInput").value


        // create html to hold user message.
        let userHtml = '<div class="userSection">'+'<div class="messages user-message">'+userMessage+'</div>'+
            '<div class="seperator"></div>'+'</div>'


        // insert user message into the page
        document.querySelector('#body').innerHTML+= userHtml;

        // open a post request to server script. pass user message as parameter
        xhr.open("POST", "query.php");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(`messageValue=${userMessage}`);


        // When response is returned, get reply text into HTML and insert in page
        xhr.onload = function () {
            let botHtml = '<div class="botSection">'+'<div class="messages bot-reply">'+this.responseText+'</div>'+
                '<div class="seperator"></div>'+'</div>'

            document.querySelector('#body').innerHTML+= botHtml;
        }

    })

</script>
