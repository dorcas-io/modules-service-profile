<div class="modal fade" id="credential-modal" tabindex="-1" role="dialog" aria-labelledby="credential-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="credential-modalLabel">New Credential</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-new-credential" method="post" v-on:submit.prevent="addCredential">
            {{ csrf_field() }}
            <h5>Add a new <strong>Credential</strong> such as certifications</h5>
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col-md-8 form-group">
                        <input class="form-control" id="title" type="text" name="title" v-model="modals.credential.title" required >
                        <label class="form-label" for="title">Institution</label>
                    </div>
                    <div class="col-md-4 form-group">
                        <select class="form-control" name="channel_credential" id="channel_credential" v-model="modals.credential.type" required>
                            <option value="" disabled="disabled">Certification Type</option>
                            <option value="degree">Degree</option>
                            <option value="course">Personal Coursework</option>
                            <option value="professional">Professional</option>
                        </select>
                        <label class="form-label" for="channel_credential">Certification Type</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 form-group">
                        <input class="form-control" id="certification" type="text" name="certification" v-model="modals.credential.certification" required>
                        <label class="form-label" for="certification">Certification e.g. Ph.D</label>
                    </div>
                    <div class="col-md-4 form-group">
                        <select class="form-control" name="year_credential" id="year_credential" v-model="modals.credential.year" required>
                            <option disabled="disabled" value="">Certification Year</option>
                            @for ($i = date('Y'); $i >= 1980; $i--))
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label class="form-label" for="year_credential">Certification Year</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 form-group">
                        <textarea id="description" name="description" class="form-control" v-model="modals.credential.description"></textarea>
                        <label class="form-label" for="description">Description</label>
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-if="!modals.credential.is_processing">Close</button>
        <button type="submit" form="form-new-credential" class="btn btn-primary" name="save_credential" value="1" :class="{'btn-loading': modals.credential.is_processing}">Save Credential</button>
      </div>
    </div>
  </div>
</div>