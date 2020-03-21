@extends('layouts.tabler')
@section('body_content_header_extras')

@endsection
@section('body_content_main')
@include('layouts.blocks.tabler.alert')

<div class="row">
    @include('layouts.blocks.tabler.sub-menu')

    <div class="col-md-9 col-xl-9" id="professional-profile">

        You can manage key aspects of your Professional Service Profile here:
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#profile_credentials">Credentials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile_experience">Experience</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile_social">Social Connections</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile_services">Services</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane container active" id="profile_credentials">
                <br/>
                <div class="row" v-if="typeof profile.professional_credentials.data !== 'undefined' && profile.professional_credentials.data.length > 0">
                    <professional-credential v-for="(credential, index) in profile.professional_credentials.data"
                                                    :key="credential.id" :credential="credential" class="m6"
                                                    :index="index" v-on:delete-credential="removeCredential">
                    </professional-credential>
                </div>
                <div class="col s12" v-if="profile.professional_credentials.data.length === 0">
                    @component('layouts.blocks.tabler.empty-fullpage')
	                    @slot('title')
	                        No Credentials
	                    @endslot
	                    Add details about your certifications in your field.
	                    @slot('buttons')
	                        <a href="#" data-toggle="modal" data-target="#credential-modal" class="btn btn-primary btn-sm">Add Credential</a>
	                    @endslot
	                @endcomponent
                </div>
            </div>
            <div class="tab-pane container" id="profile_experience">
                <br/>

                <div class="row" v-if="typeof profile.professional_experiences.data !== 'undefined' && profile.professional_experiences.data.length > 0">
                    <professional-experience v-for="(experience, index) in profile.professional_experiences.data"
                                             :key="experience.id" :experience="experience" class="m6"
                                             :index="index" v-on:delete-experience="removeExperience">

                    </professional-experience>
                </div>
                <div class="col s12" v-if="profile.professional_experiences.data.length === 0">
                    @component('layouts.blocks.tabler.empty-fullpage')
	                    @slot('title')
	                        No Experience
	                    @endslot
	                    Talk about place you have worked
	                    @slot('buttons')
	                        <a href="#" data-toggle="modal" data-target="#experience-modal" class="btn btn-primary btn-sm">Add Experience</a>
	                    @endslot
	                @endcomponent
                </div>


            </div>
            <div class="tab-pane container" id="profile_social">
                <br/>

                <div class="row" v-if="typeof profile.extra_configurations.professional_social_contacts !== 'undefined' && profile.extra_configurations.professional_social_contacts !== null && profile.extra_configurations.professional_social_contacts.length > 0">
                    <professional-social-connection v-for="(connection, index) in profile.extra_configurations.professional_social_contacts"
                                                    :key="connection.id + '-' + connection.url" :connection="connection" class="m4"
                                                    :index="index" v-on:delete-connection="removeConnection">
                    </professional-social-connection>
                </div>
                <div class="col s12" v-if="typeof profile.extra_configurations.professional_social_contacts === 'undefined' || profile.extra_configurations.professional_social_contacts === null || profile.extra_configurations.professional_social_contacts.length === 0">
                    @component('layouts.blocks.tabler.empty-fullpage')
	                    @slot('title')
	                        No Social Connections
	                    @endslot
	                    Add Social Connections for people to learn about you and connect
	                    @slot('buttons')
	                        <a href="#" data-toggle="modal" data-target="#social-connection-modal" class="btn btn-primary btn-sm">Add Social Connection</a>
	                    @endslot
	                @endcomponent
                </div>



            </div>
            <div class="tab-pane container" id="profile_services">
                <br/>
                <div class="row" v-if="typeof profile.professional_services.data !== 'undefined' && profile.professional_services.data.length > 0 && viewMode === 'professional'">
                    <professional-service v-for="(service, index) in profile.professional_services.data" :key="service.id" :service="service" class="m6"  :index="index" v-on:delete-service="removeService" v-on:edit-service="editService">
                    </professional-service>
                </div>
                <div class="row" v-if="typeof profile.vendor_services.data !== 'undefined' && profile.vendor_services.data.length > 0 && viewMode === 'vendor'">
                    <professional-service v-for="(service, index) in profile.vendor_services.data" :key="service.id" :service="service" class="m6" :index="index" v-on:delete-service="removeService" v-on:edit-service="editService">
                    </professional-service>
                </div>
                <div class="col s12" v-if="(viewMode === 'professional' && profile.professional_services.data.length === 0) || (viewMode === 'vendor' && profile.vendor_services.data.length === 0)">
                    @component('layouts.blocks.tabler.empty-fullpage')
	                    @slot('title')
	                        No Services
	                    @endslot
	                    Enter the Services you offer
	                    @slot('buttons')
	                        <a href="#" data-toggle="modal" data-target="#service-modal" class="btn btn-primary btn-sm">Add Service</a>
	                    @endslot
	                @endcomponent
                </div>



            </div>
        </div>
        @include('modules-service-profile::modals.credential')
        @include('modules-service-profile::modals.experience')
        @include('modules-service-profile::modals.social-connection')
        @include('modules-service-profile::modals.service')
    </div>

</div>


@endsection
@section('body_js')
    <script type="text/javascript">
        new Vue({
            el: '#professional-profile',
            data: {
                categories: {!! json_encode(!empty($categories) ? $categories : []) !!},
                profile: {!! json_encode(!empty($profile) ? $profile : []) !!},
                viewMode: '{{ empty($viewMode) ? 'business' : $viewMode }}',
                modals: {
                    social: {is_processing: false, channel: '', id: '', url: ''},
                    credential: {is_processing: false, title: '', type: '', year: '', description: '', certification: ''},
                    experience: {is_processing: false, company: '', designation: '', from_year: '', to_year: ''},
                    service: {is_processing: false, title: '', type: '', frequency: 'standard', currency: 'NGN', amount: 0.00, categories: [], extra_category: '', id: ''},
                }
            },
            mounted: function () {
            	//console.log(this.profile.professional_services.data.length);
                console.log(this.profile);
            },
            methods: {
                addSocialConnection: function () {
                    this.modals.social.is_processing = true;
                    var context = this;
                    axios.post("/mpp/social-connections", {
                        channel: context.modals.social.channel,
                        id: context.modals.social.id,
                        url: context.modals.social.url
                    }).then(function (response) {
                        //console.log(response);
                        context.modals.social = {is_processing: false, channel: '', id: '', url: ''};
                        context.profile.extra_configurations = response.data.extra_configurations;
                        $('#social-connection-modal').modal('hide');
                        return swal("Success", "The social connection was successfully created.", "success");
                    }).catch(function (error) {
                            var message = '';
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
	                            //var e = error.response.data.errors[0];
	                            //message = e.title;
	                            var e = error.response;
	                            message = e.data.message;
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                message = 'The request was made but no response was received';
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                message = error.message;
                            }
                            context.modals.social.is_processing = false;
                            return swal("Oops!", message, "warning");
                        });
                },
                removeConnection: function (index) {
                    this.profile.extra_configurations.professional_social_contacts.splice(index, 1);
                },
                addCredential: function () {
                    this.modals.credential.is_processing = true;
                    var context = this;
                    axios.post("/mpp/credentials", context.modals.credential)
                        .then(function (response) {
                            //console.log(response);
                            context.modals.credential = {is_processing: false, title: '', type: '', year: '', description: '', certification: ''};
                            context.profile.professional_credentials.data.push(response.data);
                            $('#credential-modal').modal('hide');
                            return swal("Success", "The credential was successfully created.", "success");
                        }).catch(function (error) {
                            var message = '';
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
	                            //var e = error.response.data.errors[0];
	                            //message = e.title;
	                            var e = error.response;
	                            message = e.data.message;
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                message = 'The request was made but no response was received';
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                message = error.message;
                            }
                            context.modals.credential.is_processing = false;
                            return swal("Oops!", message, "warning");
                        });
                },
                removeCredential: function (index) {
                    this.profile.professional_credentials.data.splice(index, 1);
                },
                addExperience: function () {
                    this.modals.experience.is_processing = true;
                    var context = this;
                    axios.post("/mpp/experiences", context.modals.experience)
                        .then(function (response) {
                            //console.log(response);
                            context.modals.experience = {is_processing: false, company: '', designation: '', from_year: '', to_year: ''};
                            context.profile.professional_experiences.data.push(response.data);
                            $('#experience-modal').modal('hide');
                            return swal("Success", "The experience was successfully created.", "success");
                        }).catch(function (error) {
                        var message = '';
                        if (error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
	                            //var e = error.response.data.errors[0];
	                            //message = e.title;
	                            var e = error.response;
	                            message = e.data.message;
                        } else if (error.request) {
                            // The request was made but no response was received
                            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                            // http.ClientRequest in node.js
                            message = 'The request was made but no response was received';
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            message = error.message;
                        }
                        context.modals.experience.is_processing = false;
                        return swal("Oops!", message, "warning");
                    });
                },
                removeExperience: function (index) {
                    this.profile.professional_experiences.data.splice(index, 1);
                },
                editService: function (index) {
                    var reference = this.viewMode === 'vendor' ? this.profile.vendor_services : this.profile.professional_services;
                    if (typeof reference.data[index] === 'undefined') {
                        return;
                    }
                    var service = reference.data[index];
                    this.modals.service.id = service.id;
                    this.modals.service.title = service.title;
                    this.modals.service.type = service.cost_type;
                    this.modals.service.frequency = service.cost_frequency;
                    this.modals.service.currency = service.cost_currency;
                    this.modals.service.amount = service.cost_amount.raw;
                    this.modals.service.categories = [];
                    for (var i = 0; i < service.categories.data.length; i++) {
                        this.modals.service.categories.push(service.categories.data[i].id);
                    }
                    $('#service-modal').modal('show');
                },
                addService: function () {
                    this.modals.service.is_processing = true;
                    var context = this;
                    context.modals.service.service_type = this.viewMode === 'vendor' ? 'vendor' : 'professional';
                    // set the service type
                    axios.post("/mpp/services", context.modals.service)
                        .then(function (response) {
                            //console.log(response);
                            var index = -1;
                            var reference = response.data.type === 'vendor' ? context.profile.vendor_services : context.profile.professional_services;
                            if (typeof response.data.id !== 'undefined') {
                                for (var i = 0; i < reference.data.length; i++) {
                                    if (reference.data[i].id !== response.data.id) {
                                        continue;
                                    }
                                    index = i;
                                    break;
                                }
                            }
                            if (index > -1) {
                                if (context.viewMode === 'vendor') {
                                    context.profile.vendor_services.data[index] = response.data;
                                } else {
                                    context.profile.professional_services.data[index] = response.data;
                                }
                            } else {
                                if (context.viewMode === 'vendor') {
                                    context.profile.vendor_services.data.push(response.data);
                                } else {
                                    context.profile.professional_services.data.push(response.data);
                                }
                            }
                            context.modals.service = {is_processing: false, title: '', type: '', frequency: 'standard', currency: 'NGN', amount: 0.00, categories: [], extra_category: '', id: ''};
                            $('#service-modal').modal('hide');
                            return swal("Success", "The service was successfully created.", "success");
                        }).catch(function (error) {
                            console.log(error);
                            var message = '';
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
	                            //var e = error.response.data.errors[0];
	                            //message = e.title;
	                            var e = error.response;
	                            message = e.data.message;
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                message = 'The request was made but no response was received';
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                message = error.message;
                            }
                            context.modals.service.is_processing = false;
                            return swal("Oops!", message, "warning");
                    });
                },
                cancelServiceEdit: function () {
                    this.modals.service = {is_processing: false, title: '', type: '', frequency: 'standard', currency: 'NGN', amount: 0.00, categories: [], extra_category: '', id: ''};
                },
                removeService: function (index) {
                    this.profile.professional_services.data.splice(index, 1);
                },
            },
        })
    </script>
@endsection
