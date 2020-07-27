<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form>
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Year</label>
            <input type="text" class="col-sm-9 form-control" id="year" />
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Month</label>
            <input type="text" class="col-sm-9 form-control" id="month" />
          </div>
          <div class="form-group row">
            <label for="title" class="col-sm-3 col-form-label">Day</label>
            <input type="text" class="col-sm-9 form-control" id="day" />
          </div>
          <div class="form-group row">
            <label for="content" class="col-sm-3 col-form-label">Account</label>
            <input type="text" class="col-sm-9 form-control" id="account" />
          </div>
          <div class="form-group row">
            <label for="person-in-charge" class="col-sm-3 col-form-label">Price</label>
            <input type="text" class="col-sm-9 form-control" id="price" />
          </div>
          <div class="form-group row">
            <label for="person-in-charge" class="col-sm-3 col-form-label">Journal</label>
            <input type="text" class="col-sm-9 form-control" id="journal" />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>
