@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <!-- Intel input phone number plugin -->
    <script>
        const vueApp = Vue.createApp({
            data() {
                return {
                    form_data: {
                        tags: [],
                        type:'student'
                    },
                    maskConfig: {
                        definitions: {
                            '*': {
                                validator: "[0-9]"
                            }
                        },
                        mask: '###-###-####',
                        placeholder: '#'
                    },
                    maskConfigBirthDay: {
                        definitions: {
                            '*': {
                                validator: "[0-9]"
                            }
                        },
                        mask: '##/##/####',
                        placeholder: '#'
                    },
                }
            },
            mounted() {
                $("#home_phone").inputmask(this.maskConfig)
                $("#cell_phone").inputmask(this.maskConfig)
                $("#edit_phone").inputmask(this.maskConfig)
                $(".date_input").inputmask(this.maskConfigBirthDay)
            },
            methods: {
                renderTags() {
                    console.log(event)
                },
                save() {
                    this.form_data.inActive = $('#inActive').val()
                    this.form_data.enrollment = $('#enrollment').val()
                    this.form_data.home_phone = $('#home_phone').val()
                    this.form_data.cell_phone = $('#cell_phone').val()
                    axios.post('/profile', this.form_data).then((res) => {
                        window.location.reload();
                    })
                }
            },
        })
        vueApp.mount('#vue-app');
    </script>

@endpush

<div class="row my-2" id="vue-app">
    <div class="col">
        <form>
            @csrf
            {{--hidden utc start time--}}
            <input type="hidden" name="utcStartTime" class="utc-start-time">

            {{--Create User--}}
            <div class="card mb-1">
                <div class="card-header">
                    <h5>
                        <i class="fas fa-user-plus mr-1"></i>
                        Create User
                    </h5>

                    {{--Errors--}}
                    @if( $errors->any() )
                        @foreach($errors->all() as $error)
                            <span
                                class="alert alert-danger text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <strong>Whoops!</strong>
                                    {{ $error }}
                                </span>
                        @endforeach
                    @endif

                    @if($errors->any() || session('badgeMessage'))
                        <div class="row mt-1">
                            <div class="col-12">
                                {{--Badge Message--}}
                                @if( session('badgeMessage') )
                                    <span
                                        class="alert alert-success text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <strong>{{ session('badgeMessage') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        {{--First Name--}}
                        <div class="col-6">
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')"/>
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                              v-model="form_data.first_name"
                                              :value="old('first_name')" required autofocus autocomplete="first_name"/>
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                            </div>
                        </div>
                        {{--Last Name--}}
                        <div class="col-6">
                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')"/>
                                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                              v-model="form_data.last_name"
                                              :value="old('last_name')" required autofocus autocomplete="last_name"/>
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        {{--First Name--}}
                        <div class="col-6">
                            <div>
                                <x-input-label for="birth_day" :value="__('Birth Day')"/>
                                <x-text-input id="birth_day" class="block mt-1 w-full date_input" type="text"
                                              name="birth_day"
                                              v-model="form_data.birth_day"
                                              :value="old('birth_day')" required autofocus autocomplete="birth_day"/>
                                <x-input-error :messages="$errors->get('birth_day')" class="mt-2"/>
                            </div>
                        </div>
                        {{--Last Name--}}
                        <div class="col-6">
                            <label for="gender">Gender</label>
                            <select
                                id="gender"
                                name="gender"
                                class="form-control" v-model="form_data.gender" required>
                                <option value="male"
                                        @if( old('gender') === 'male' ) selected @endif>
                                    Male
                                </option>
                                <option value="female"
                                        @if(old('gender') === 'female') selected @endif >female
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-1">
                        {{--phone input--}}
                        <div class="col-6 col-lg-3 mb-1">

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-phone-office"></i>
                                </span>
                                <label for="home_phone"></label>
                                <input id="home_phone"
                                       type="text"
                                       class="form-control"
                                       name="home_phone"
                                       placeholder="Home Phone"
                                >
                            </div>
                            <div class="my-1">
                                @if ($errors->has('home_phone'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Home Phone is required!
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 mb-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-mobile-android"></i>
                                </span>
                                <label for="cell_phone"></label>
                                <input id="cell_phone"
                                       type="text"
                                       class="form-control"
                                       name="cell_phone"
                                       placeholder="Cell Phone"
                                >
                            </div>
                            <div class="my-1">
                                @if ($errors->has('cell_phone'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Cell Phone is required!
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--email input--}}
                        <div class="col-6 col-lg-6 mb-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <label for="email"></label>
                                <input id="email"
                                       type="text"
                                       class="form-control"
                                       name="email"
                                       placeholder="Email" v-model="form_data.email">
                            </div>
                            <div class="my-1">
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Email is required!
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--role input--}}
                        <div class="col-6 col-lg-6 mb-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-person-circle-question"></i>
                                </span>
                                <label for="role"></label>
                                <select id="role"
                                        name="role"
                                        class="form-control" v-model="form_data.type"
                                        required>
                                    <option value="admin"
                                            @if( old('role') === 'admin' ) selected @endif>
                                        Admin
                                    </option>
                                    <option value="student"
                                            @if(old('role') === 'student') selected @endif
                                    >Student
                                    </option>
                                    <option value="teacher"
                                            @if(old('role') === 'teacher') selected @endif
                                    >Teacher
                                    </option>
                                </select>
                            </div>
                            <div class="my-1">
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Role is required!
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--password input--}}
                        <div class="col-6 col-lg-6 mb-1">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <label for="password"></label>
                                <input id="password"
                                       type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Password" v-model="form_data.Password"
                                >
                            </div>
                            <div class="my-1">
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Password is required!
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--address 1 input--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="address_1" :value="__('Address 1')"/>
                                <x-text-input id="address_1" class="block mt-1 w-full" type="text" name="address_1"
                                              v-model="form_data.address_1"
                                              :value="old('address_1')" required autofocus autocomplete="address_1"/>
                                <x-input-error :messages="$errors->get('address_1')" class="mt-2"/>
                            </div>
                        </div>
                        {{--address 2 input--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="address_2" :value="__('Address 2')"/>
                                <x-text-input id="address_2" class="block mt-1 w-full" type="text" name="address_2"
                                              v-model="form_data.address_2"
                                              :value="old('address_2')" required autofocus autocomplete="address_2"/>
                                <x-input-error :messages="$errors->get('address_2')" class="mt-2"/>
                            </div>
                        </div>
                        {{--city input--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="city" :value="__('City')"/>
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                              v-model="form_data.city"
                                              :value="old('city')" required autofocus autocomplete="city"/>
                                <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                            </div>
                        </div>
                        {{--state input--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="state" :value="__('State')"/>
                                <x-text-input id="state" class="block mt-1 w-full" type="text" name="state"
                                              v-model="form_data.state"
                                              :value="old('state')" required autofocus autocomplete="state"/>
                                <x-input-error :messages="$errors->get('state')" class="mt-2"/>
                            </div>
                        </div>
                        {{--Postal Code input--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="postal_code" :value="__('Postal Code')"/>
                                <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                                              v-model="form_data.postal_code"
                                              :value="old('postal_code')" required autofocus
                                              autocomplete="postal_code"/>
                                <x-input-error :messages="$errors->get('postal_code')" class="mt-2"/>
                            </div>
                        </div>
                        {{--Country input--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="country" :value="__('country')"/>
                                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country"
                                              v-model="form_data.country"
                                              :value="old('country')" required autofocus autocomplete="country"/>
                                <x-input-error :messages="$errors->get('country')" class="mt-2"/>
                            </div>
                        </div>
                        {{--make inActive--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="inActive" :value="__('Make inActive')"/>
                                <x-text-input id="inActive" class="block mt-1 w-full date_input" type="text"
                                              name="inActive"
                                              :value="old('inActive')" required autofocus autocomplete="inActive"/>
                                <x-input-error :messages="$errors->get('inActive')" class="mt-2"/>
                            </div>
                        </div>
                        {{--Enrollment date--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="enrollment" :value="__('Enrollment')"/>
                                <x-text-input id="enrollment" class="block mt-1 w-full date_input" type="text"
                                              name="enrollment"
                                              :value="old('enrollment')" required autofocus autocomplete="enrollment"/>
                                <x-input-error :messages="$errors->get('enrollment')" class="mt-2"/>
                            </div>
                        </div>

                        {{--Tags --}}
                        <div class="col-6 col-lg-6 mb-1">
                            <div>
                                <x-input-label for="tags" :value="__('Tags')"/>
                                <textarea
                                    class="block p-2 mt-1 w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    name="tags" id="tags" cols="30" rows="1" @input="renderTags"></textarea>
                                <x-input-error :messages="$errors->get('tags')" class="mt-2"/>
                            </div>
                        </div>

                        {{--school_name --}}
                        <div class="col-6 col-lg-3 mb-1" v-if="form_data.type === 'student'">
                            <div>
                                <x-input-label for="school_name" :value="__('School name')"/>
                                <x-text-input id="school_name" class="block mt-1 w-full " type="text"
                                              v-model="form_data.school_name"
                                              name="school_name" school_namerequired autofocus autocomplete="school_name"/>
                                <x-input-error :messages="$errors->get('school_name')" class="mt-2"/>
                            </div>
                        </div>

                        {{--grade --}}
                        <div class="col-6 col-lg-3 mb-1" v-if="form_data.type === 'student'">
                            <div>
                                <x-input-label for="grade" :value="__('Grade')"/>
                                <x-text-input id="grade" class="block mt-1 w-full " type="text"
                                              v-model="form_data.grade"
                                              name="grade" school_namerequired autofocus autocomplete="grade"/>
                                <x-input-error :messages="$errors->get('grade')" class="mt-2"/>
                            </div>
                        </div>

                        {{--Background --}}
                        <div class="col-6 col-lg-3 mb-1" v-if="form_data.type === 'student'">
                            <div>
                                <x-input-label for="background" :value="__('Background')"/>
                                <x-text-input id="background" class="block mt-1 w-full " type="text"
                                              v-model="form_data.background"
                                              name="background" school_namerequired autofocus autocomplete="background"/>
                                <x-input-error :messages="$errors->get('background')" class="mt-2"/>
                            </div>
                        </div>
                        {{--special_need--}}
                        <div class="col-6 col-lg-3 mb-1" v-if="form_data.type === 'student'">
                            <div>
                                <x-input-label for="special_need" :value="__('Special need')"/>
                                <x-text-input id="special_need" class="block mt-1 w-full " type="text"
                                              v-model="form_data.special_need"
                                              name="special_need" school_namerequired autofocus autocomplete="special_need"/>
                                <x-input-error :messages="$errors->get('special_need')" class="mt-2"/>
                            </div>
                        </div>
                        {{--allergies--}}
                        <div class="col-6 col-lg-3 mb-1" v-if="form_data.type === 'student'">
                            <div>
                                <x-input-label for="allergies" :value="__('Allergies')"/>
                                <x-text-input id="allergies" class="block mt-1 w-full " type="text"
                                              v-model="form_data.allergies"
                                              name="allergies" school_namerequired autofocus autocomplete="allergies"/>
                                <x-input-error :messages="$errors->get('allergies')" class="mt-2"/>
                            </div>
                        </div>

                        {{--notes--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="notes" :value="__('Notes')"/>
                                <x-text-input id="notes" class="block mt-1 w-full " type="text"
                                              v-model="form_data.notes"
                                              name="notes" school_namerequired autofocus autocomplete="notes"/>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2"/>
                            </div>
                        </div>

                        {{--Source--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="source" :value="__('Source')"/>
                                <x-text-input id="source" class="block mt-1 w-full " type="text"
                                              v-model="form_data.source"
                                              name="source" school_namerequired autofocus autocomplete="source"/>
                                <x-input-error :messages="$errors->get('source')" class="mt-2"/>
                            </div>
                        </div>


                        {{--customer_number--}}
                        <div class="col-6 col-lg-3 mb-1">
                            <div>
                                <x-input-label for="customer_number" :value="__('Customer number')"/>
                                <x-text-input id="customer_number" class="block mt-1 w-full " type="text"
                                              v-model="form_data.customer_number"
                                              name="customer_number" school_namerequired autofocus autocomplete="customer_number"/>
                                <x-input-error :messages="$errors->get('customer_number')" class="mt-2"/>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success bg-success btn-sm px-4 float-right save-btn"
                            @click="save">
                        <i class="fas fa-save mr-1"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
