<!-- ACTION - UPLOAD MODAL -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Attach File</h5>
        <button type="button" class="btn-close upload" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Browse from device:
        <br/>
        <div class="uploadbox" id="uploadDiv">
  <i class="fa-solid fa-upload fa-4x"></i>
  <form action="connect_uploaddb.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="hiddenFileInput" style="display: none;">
    <input type="submit" value="Upload" style="display: none;">
    
  </form>
</div>

        <span class="uploadsubtext">Note: If possible, please use a stable internet connection to avoid errors when uploading. Sudden interruptions/spike may cause it to fail.</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit" data-dismiss="modal">Submit</button>
      </div>
    </div>
  </div>
</div>
