<div class="modal fade" id="experience-modal" tabindex="-1" role="dialog" aria-labelledby="experience-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="experience-modalLabel">Experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-new-experience" method="post" v-on:submit.prevent="addExperience">
            {{ csrf_field() }}
            <h4>Add a new <strong>Credential</strong> such as certifications, etc...</h4>
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control" id="company" type="text" name="company" v-model="modals.experience.company" required>
                        <label class="form-label" for="company">Company</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control" id="designation" type="text" name="designation" v-model="modals.experience.designation" required>
                        <label class="form-label" for="designation">Designation/Position</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <select class="form-control" name="year" id="year" v-model="modals.experience.from_year" required>
                            <option disabled="disabled" value="">From Year</option>
                            @for ($i = 1980; $i <= date('Y'); $i++))
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label class="form-label" for="year">From Year</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <select class="form-control" name="year" id="year" v-model="modals.experience.to_year">
                            <option disabled="disabled" value="">To Year</option>
                            @for ($i = date('Y'); $i >= 1980; $i--))
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label class="form-label" for="year">To Year</label>
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-if="!modals.experience.is_processing">Close</button>
        <button type="submit" form="form-new-experience" class="btn btn-primary" name="save_experience" value="1" v-if="!modals.experience.is_processing">Save Experience</button>
      </div>
    </div>
  </div>
</div>
