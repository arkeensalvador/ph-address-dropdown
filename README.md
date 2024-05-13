<h1>Philippine Address Dependent Dropdown</h1>

![image](https://github.com/arkeensalvador/ph-address-dropdown/assets/99806440/a95e7d7f-afb9-4a8d-a47d-596c0a6d8625)

<h3>Requirements:</h3>
<ul>
  <li>Jquery</li>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<button id="copyButton">Copy Script</button>
</ul>


<script>
$(document).ready(function(){
    // When the button is clicked
    $("#copyButton").click(function(){
        // Create a temporary textarea element
        var tempTextarea = $("<textarea>");
        // Set its value to the script content
        tempTextarea.text('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>');
        // Append it to the body
        $("body").append(tempTextarea);
        // Select its content
        tempTextarea.select();
        // Copy the selected content
        document.execCommand("copy");
        // Remove the temporary textarea
        tempTextarea.remove();
        // Notify the user
        alert("Script copied to clipboard!");
    });
});
</script>
