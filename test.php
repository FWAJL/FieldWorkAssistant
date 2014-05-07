Hello.
<script>

function myFunction() {
   // Open a form by ID and log the responses to each question.
 var form = FormApp.openById('11HPMiw9_kns-wNppfQM1EKvnrmt1P9O56aXxfQvyKZ0');
 var formResponses = form.getResponses();
  var id = form.getId();

	document.write(id);
}
</script>