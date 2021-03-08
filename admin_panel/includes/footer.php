<footer id="footer">
    <p>The News Field</p>
    <p>&copy; <?php echo date("Y"); ?></p>
</footer>

<!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="insert_post.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add News Post</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>News Title</label>
          <input type="text" name="news_title" class="form-control" placeholder="News Title">
        </div>
        <div class="form-group">
          <label>News Tag</label>
          <input type="text" name="news_tag" class="form-control" placeholder="Add News tag">
        </div>
        <div class="form-group">
          <label>News Category</label>
          <select class="form-control" name="news_category">
            <option value="0">Select Category</option>
            <option value="काय चाललंय !">काय चाललंय !</option>
            <option value="झाल कि व्हायरल !">झाल कि व्हायरल !</option>
            <option value="खास तुमच्यासाठी !">खास तुमच्यासाठी !</option>
            <option value="आपलं राजकारण">आपलं राजकारण</option>
            <option value="किस्से">किस्से</option>
            <option value="मायानगरी">मायानगरी</option>
            <option value="बळीराजा">बळीराजा</option>
            <option value="खेळ-कुद">खेळ-कुद</option>
            <option value="आरोग्य">आरोग्य</option>
          </select>
        </div>
        <div class="form-group">
          <label>News Thumbnail</label>
          <input type="file" name="myfile" id="fileToUpload" class="form-control" />
        </div>
        <div class="form-group">
          <label>News Body</label>
          <textarea name="news_desc" class="form-control" placeholder="News Body"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Save changes" />
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
    var editor = CKEDITOR.replace( 'news_desc', {
      height: 300,
      filebrowserUploadUrl: "upload.php"
    });

    // editor.on('afterCommandExec', handleAfterCommandExec);
    // function handleAfterCommandExec(event)
    // {
    //   var commandName = event.data.name;
    //   alert(commandName);
    //   if(commandName == 'source'){
    //     twttr.widgets.load();
    //   }
    // }

 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>