<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog editmod" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Personal Information</h5>
        <button type="button" class="btn-close upload" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" action="generatepdf_ce.php" target="_blank">
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input1">First Name</label>
                  <input type="text" maxlength="50" class="form-control" id="input1" name="firstName">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="input2">Middle</label>
                  <input type="text" maxlength="50" class="form-control" id="input2" name="middleName">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input3">Last Name</label>
                  <input type="text" maxlength="100" class="form-control" id="input3" name="lastName">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="input4">Suffix</label>
                  <input type="text" maxlength="5" class="form-control" id="input4" name="nameSuffix">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input5">Student Number</label>
                  <input type="text" maxlength="50" class="form-control" id="input5" name="studentNumber">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="input6">Yr&Sec</label>
                  <input type="text" maxlength="10" class="form-control" id="input6" name="courseYrSec">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input7">Academic Year</label>
                  <input type="text" pattern="20[2-9][0-9]-20[2-9][0-9]" maxlength="9" class="form-control" id="input7" name="acadYear">
                </div>
              </div>
            </div>

            <!-- Rest of the code -->

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input8">Course Code</label>
                  <input type="text" maxlength="10"  class="form-control" id="input8" name="courseCode">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="input9">Course Description</label>
                  <input type="text" class="form-control" id="input9" name="description">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="input10">Units</label>
                  <input type="text" class="form-control" id="input10" name="units">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input11">Course Code</label>
                  <input type="text" maxlength="10"  class="form-control" id="input11" name="courseCode">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="input12">Course Description</label>
                  <input type="text" class="form-control" id="input12" name="description">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="input13">Units</label>
                  <input type="text" class="form-control" id="input13" name="units">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input14">Course Code</label>
                  <input type="text" maxlength="10"  class="form-control" id="input14" name="courseCode">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="input15">Course Description</label>
                  <input type="text" class="form-control" id="input15" name="description">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="input16">Units</label>
                  <input type="text" class="form-control" id="input16" name="units">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="input17">Academic Year</label>
                  <input type="text" class="form-control" id="input17" name="acadyear" placeholder="2020-2021">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="input18">PUP Branch</label>
                  <input type="text" class="form-control" id="input18" name="pupBranch">
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary submit">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>