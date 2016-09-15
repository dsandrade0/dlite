# jQuery Validation Bootstrap

This is just an extension of the [jQuery validation plugin](http://jqueryvalidation.org/) to be used with [Bootstrap](http://getbootstrap.com).

## Usage

The plugin only extends *validate* method of the original jQuery validation plugin, so use
it exactly the same way.

```html
<!-- Bootstrap -->
<link rel="stylesheet" href="path/to/bootstrap.min.css">
<link rel="stylesheet" href="path/to/bootstrap-theme.min.css">
<script src="path/to/bootstrap.min.js"></script>

<!-- jQuery -->
<script type="text/javascript" src="path/to/jquery.min.js"></script>

<!-- jQuery Validate -->
<script type="text/javascript" src="path/to/jquery.validate.js"></script>

<!-- jQuery Validate Bootstrap -->
<script type="text/javascript" src="path/to/jquery.validate.bootstrap.js"></script>

<!-- Your form -->
<form id="form" novalidate="novalidate">
    <div class="form-group">
        <label class="control-label" for="input-firstName">
            First Name
        </label>
        <input type="text" class="form-control" name="firstName"
        	id="input-firstName" placeholder="Your First Name..." required>
        <span class="help-block"></span>
    </div>
</form>

<!-- Plugin initialization -->
<script>
	$(document).ready(function() {
		$('#form').validate();
	});
</script>
```