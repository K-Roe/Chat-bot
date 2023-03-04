

<div id="bot">
    <div id="container">
        <div id="header">
            Online Chatbot App
        </div>

        <div id="body">
            <!-- This section will be dynamically inserted from JavaScript -->
            <div class="userSection">
                <div class="messages user-message">

                </div>
                <div class="seperator"></div>
            </div>
            <div class="botSection">
                <div class="messages bot-reply">

                </div>
                <div class="seperator"></div>
            </div>
        </div>

        <div id="inputArea">
            <input type="text" name="messages" id="userInput" placeholder="Please enter your message here" required>
            <input type="submit" id="send" value="Send">
        </div>
    </div>
</div>


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


