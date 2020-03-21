<div class="modal fade" id="experience-modal" tabindex="-1" role="dialog" aria-labelledby="experience-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="experience-modalLabel">New Experience</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-new-experience" method="post" v-on:submit.prevent="addExperience">
            {{ csrf_field() }}
            <h5>Add a new <strong>Experience</strong> such as current/previous employment</h5>
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
                        <select class="form-control" name="year_experience_from" id="year_experience_from" v-model="modals.experience.from_year" required>
                            <option disabled="disabled" value="">From Year</option>
                            @for ($i = 1980; $i <= date('Y'); $i++))
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label class="form-label" for="year_experience_from">From Year</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <select class="form-control" name="year_experience_to" id="year_experience_to" v-model="modals.experience.to_year">
                            <option disabled="disabled" value="">To Year</option>
                            @for ($i = date('Y'); $i >= 1980; $i--))
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label class="form-label" for="year_experience_to">To Year</label>
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-if="!modals.experience.is_processing">Close</button>
        <button type="submit" form="form-new-experience" class="btn btn-primary" name="save_experience" value="1" :class="{'btn-loading': modals.experience.is_processing}">Save Experience</button>
      </div>
    </div>
  </div>
</div>
