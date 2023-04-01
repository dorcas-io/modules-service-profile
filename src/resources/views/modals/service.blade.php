<div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="service-modalLabel">New Service</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-service" method="post" v-on:submit.prevent="addService">
            {{ csrf_field() }}
            <h5>Add a new <strong>Service</strong> that you wish to offer to businesses</h5>
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control" id="service_title" type="text" name="service_title" v-model="modals.service.title" required>
                        <label class="form-label" for="service_title">Title</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control" id="service_categories" type="text" name="service_categories" v-model="modals.service.extra_category">
                        <label class="form-label" for="service_categories">Additional Categories (separate by comma)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 form-group">
                        <select class="form-control" name="service_type" id="service_type" v-model="modals.service.type" required>
                            <option disabled="disabled" value="">Service Type</option>
                            <option value="free">Free</option>
                            <option value="paid">Paid</option>
                        </select>
                        <label class="form-label" for="service_type">Service Type</label>
                    </div>
                    <div class="col-xl-3 col-md-6 form-group">
                        <select class="form-control" name="service_frequency" id="service_frequency" v-model="modals.service.frequency" required>
                            <option disabled="disabled" value="">Payment Frequency</option>
                            <option value="hour">per Hour</option>
                            <option value="day">per Day</option>
                            <option value="week">per Week</option>
                            <option value="month">per Month</option>
                            <option value="standard">Standard (per Job)</option>
                        </select>
                        <label class="form-label" for="service_frequency">Payment Frequency</label>
                    </div>
                    <div class="col-xl-3 col-md-6 form-group">
                        <select class="form-control" name="service_currency" id="service_currency" v-model="modals.service.currency" required>
                            <option disabled="disabled" value="">Currency</option>
                            <option value="NGN">Nigerian Naira</option>
                            <option value="USD">US Dollars</option>
                            <option value="EUR">Euro</option>
                            <option value="GBP">Pound Sterling</option>
                        </select>
                        <label class="form-label" for="service_currency">Currency</label>
                    </div>
                    <div class="col-xl-3 col-md-6 form-group">
                        <input class="form-control" id="service_cost" type="number" step="1" min="1" name="service_cost" v-model="modals.service.amount" required>
                        <label class="form-label" for="service_cost">Service Cost</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group" v-if="categories.length > 0">
                        <select class="form-control" name="categories[]" id="categories" v-model="modals.service.categories" multiple size="5">
                            <option disabled="disabled" value="">Select One or more categories</option>
                            @if (!empty($categories))
                                @foreach ($categories as $category)
                                    @if (!empty($category->parent))
                                        @continue
                                    @endif
                                    <option value="{{ $category->id }}">{{ title_case($category->name) }}</option>
                                    @if (!empty($category->children))
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->children['data'] as $subCat)
                                                    <option value="{{ $subCat->id }}">{{ title_case($subCat->name) }}</option>
                                                @endforeach
                                            </optgroup>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <label class="form-label" for="categories">Categories</label>
                    </div>
                </div>
            </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-if="!modals.service.is_processing" v-on:click="cancelServiceEdit">Cancel</button>
        <button type="submit" form="form-service" class="btn btn-primary" name="save_experience" value="1" :class="{ 'btn-loading': modals.service.is_processing }">Save Service</button>
      </div>
    </div>
  </div>
</div>
