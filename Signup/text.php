<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<input type="checkbox" id="toggleCheckbox"> Enable/Disable Paragraph
<p id="myParagraph" contenteditable="false">This is an editable paragraph.</p>
<input type="checkbox" id="targetCheckbox"> Disable This Checkbox

<script type="text/javascript">
	// Get references to the controlling checkbox, paragraph, and target checkbox
var toggleCheckbox = document.getElementById("toggleCheckbox");
var paragraph = document.getElementById("myParagraph");
var targetCheckbox = document.getElementById("targetCheckbox");

// Add a change event listener to the controlling checkbox
toggleCheckbox.addEventListener("change", function() {
  // Toggle the contenteditable attribute based on the controlling checkbox's checked state
  paragraph.contentEditable = toggleCheckbox.checked;
  
  // Enable or disable the target checkbox based on the controlling checkbox's state
  targetCheckbox.disabled = toggleCheckbox.checked;
});

</script>
</body>
</html>