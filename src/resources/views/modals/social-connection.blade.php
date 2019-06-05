<div class="modal fade" id="social-connection-modal" tabindex="-1" role="dialog" aria-labelledby="social-connection-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="social-connection-modalLabel">Social Connection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-social-connection" method="post" v-on:submit.prevent="addSocialConnection">
            {{ csrf_field() }}
            <h4>Add a new <strong>Social Connection</strong></h4>
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <select name="channel" id="channel" class="form-control" v-model="modals.social.channel">
                            <option value="" disabled="disabled">Social Network</option>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="googleplus">Google+</option>
                            <option value="twitter">Twitter</option>
                            <option value="youtube">Youtube</option>
                        </select>
                        <label class="form-label" for="title">Social Network</label>
                    </div>
                    <div class="col-md-4 form-group">
                        <input class="form-control" id="id" type="text" name="id" v-model="modals.social.id">
                        <label class="form-label" for="id">ID (e.g. @username)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input class="form-control" id="url" type="url" name="url" v-model="modals.social.url">
                        <label class="form-label" for="url">Profile URL</label>
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-if="!modals.social.is_processing">Close</button>
        <button type="submit" form="form-social-connection" class="btn btn-primary" name="save_product" value="1" v-if="!modals.social.is_processing">Save Connection</button>
      </div>
    </div>
  </div>
</div>