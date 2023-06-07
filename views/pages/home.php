<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 content">
			<div class="row">
				<div class="col-md-12 content-button">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mailModal">
               Mail
               </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
               Add
               </button>
               
				</div>
			</div>
         <div class="row">
				<div class="col-md-12 content-table" >
            <form id="updateform" method="post" action="route.php" enctype="multipart/form-data">
                        
                    <table class="table" id="article-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th width="150px">Date Published</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th width="150px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                              
                            <?php $results = json_decode($data);
                              if($results) { 
                              foreach($results as $row) {
                            ?>
                              
                              <tr>
                                 <td><?php echo $row->id;?></td>
                                 <td><?php echo $row->title;?></td>
                                 <td><?php echo date('F j, Y', strtotime($row->date));?></td>
                                 <td><img width='70px' height='70px' src="views/uploads/<?php echo $row->image; ?>"/></td>
                                 <td><?php echo $row->content;?></td>
                                 <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal-<?php echo $row->id; ?> ">Edit</button>
                                    <button type="button" class="btn btn-danger deletearticle"  id="<?php echo $row->id; ?>">Delete</button>
                                 </td>
                              </tr>
                                <div class="modal fade" id="updateModal-<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="updateModal-<?php echo $row->id; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Article</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                             <?php $model = new Model();
                                             $article = json_decode($model->get($row->id));
                                             foreach($article as $art) {
                                              ?>
                                              <input type='hidden' name="update_id" name="update_id" value="<?php echo $art->id;?>" />
                                             <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" id="update_title" name="update_title" placeholder="Title" value="<?php echo $art->title;?>" required="required">
                                             </div>
                                             <div class="form-group">
                                                <label>Content</label>
                                                <textarea class="form-control" id="update_content" name="update_content"  rows="3" placeholder="Content"><?php echo $art->content;?></textarea>
                                             </div>
                                             <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" id="update_fileToUpload" name="update_fileToUpload" type="file">
                                                <span class="note">Leave it black if you do not want to update</span>
                                             </div>
                                             <?php }?>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <input type="submit" class="btn btn-primary" value="Save changes" name="updatearticle">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 
                             <?php } }?>
                            
                       
                        </tbody>
                    </table>
                    </form>
                </div>
		    </div>
         <form id="addform" method="post" action="route.php" enctype="multipart/form-data">
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">Add Article</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="form-group">
                           <label>Title</label>
                           <input type="text" class="form-control" id="title" name="title" placeholder="Title" required="required">
                        </div>
                        <div class="form-group">
                           <label>Content</label>
                           <textarea class="form-control" id="content" name="content"  rows="3" placeholder="Content"></textarea>
                        </div>
                        <div class="form-group">
                           <label>Image</label>
                           <input class="form-control" id="fileToUpload" name="fileToUpload" type="file" require="required">
                        </div>
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <input type="submit" class="btn btn-primary" value="Save changes" name="addarticle">
                     </div>
                  </div>
               </div>
            </div>
            </form>

            <form id="mailform" method="post" action="route.php" >
            <div class="modal fade" id="mailModal" tabindex="-1" aria-labelledby="mailModal" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">Mail Article</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                     <label>Date</label>
                     <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" id="date" name="date" required/>
                        <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                           <i class="fa fa-calendar"></i>
                        </span>
                        </span>
                     </div>
                     <div class="form-group">
                           <label>Recipient</label>
                           <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Recipient" required="required">
                        </div>
                       
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <input type="submit" class="btn btn-primary" value="Send" id="mailarticle" name="mailarticle">
                     </div>
                  </div>
               </div>
            </div>
            </form>
           
		</div>	
	</div>
</div>