<?php
    include "base.php";
?>

<form method="POST" action="">
  <div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" class="form-control" id="fnam" name="first_name">
  </div>
  <div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control" id="lnam" name="last_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="u_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  <div class="form-group col-md-4">
      <label for="inputState">Country</label>
      <select id="inputState" class="form-control" name="u_country">
        <option selected>Choose...</option>
        <option>Afghanistan</option>
        <option>Albania</option>
        <option>Algeria</option>
        <option>Andorra</option>
        <option>Angola</option>
        <option>Armenia</option>
        <option>India</option>
      </select>
    </div>
    <div class="form-group col-md-4">
    <label >Gender</label>
  <div class="form-check">
  
  <input class="form-check-input" type="radio" name="gender" id="male" value="M" checked>
  <label class="form-check-label" for="male">
    Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="gender" id="fmale" value="F">
  <label class="form-check-label" for="fmale">
  Female
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="gender" id="other" value="O">
  <label class="form-check-label" for="other">
  Other
  </label>
</div>
    </div>
<div class="form-group row">
  <label for="example-date-input" class=" col-2 col-form-label">Date Of Birth</label>
  <div class="">
    <input class="form-control" type="date" name="u_birthday" id="example-date-input">
  </div>
</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="u_pass" id="exampleInputPassword1">
  </div>

  <button type="submit" name="signup" class="btn btn-primary">Submit</button>

  <?php include("insert_user.php"); ?>
</form>