<!--Add Party List -->
<div class="modal fade" id="addPartyListModal" tabindex="-1" role="dialog" aria-labelledby="addPartyListModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="addPartyListModalLabel"><b>Add Party List</b></h4>
        </button>
      </div>
      <div class="modal-body">
        <form id="partyListForm" method="post" action="process/party_add.php">
          <div class="form-group">
            <label for="partyName">Party List Name</label>
            <input type="text" class="form-control" id="partyName" name="partyName" required>
          </div>
          <div class="form-group">
            <label for="partyDescription">Description</label>
            <textarea class="form-control" id="partyDescription" name="partyDescription" rows="3" required></textarea>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
          </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><b>Deleting...</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="party_delete.php">
                    <input type="hidden" class="party_id" name="party_id">
                    <div class="text-center">
                        <p>DELETE PARTY</p>
                        <h2 class="bold party_name"></h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

