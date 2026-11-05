  <div class="card border-0 shadow mb-4 p-3 text-center">

                    <h5 class="mt-3 mb-0">
                        {{ Auth::user()->name }}
                    </h5>

                    <p class="text-muted mb-2">
                        {{ Auth::user()->desigination ?? 'No Designation' }}
                    </p>

                    <button class="btn btn-primary btn-sm">
                        Change Picture
                    </button>

                </div>

                <!-- Sidebar Menu -->
                <div class="card border-0 shadow">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <a href="{{ route('personal_details') }}">
                                Personal Details
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('adress') }}">
                                Address
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('education') }}">
                                Education
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('skills') }}">
                                Skills
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('experience') }}">
                                Experience
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('languages') }}">
                                Languages
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{ route('account.logout') }}"
                               class="text-danger">
                                Logout
                            </a>
                        </li>

                    </ul>

                </div>