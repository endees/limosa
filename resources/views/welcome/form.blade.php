

<form id="steps" method="POST" enctype="multipart/form-data" action="{{ route('form.register') }}">
    <!-- step 1 -->
    @csrf
    <div id="step1" class="form-inner lightSpeedIn step-container" data-step-number="1">
        <h1>Krok 1</h1>
        <h3>Dane rejestrującego:</h3>

        <div class="input-field">
            <label for="firstname">Imię<span>*</span></label>
            <input required type="text" name="firstname" id="firstname" placeholder="Imię" v-model="formData.firstname">
        </div>
        <div class="input-field">
            <label for="lastname">Nazwisko<span>*</span></label>
            <input required type="text" name="lastname" id="lastname" placeholder="Nazwisko" v-model="formData.lastname">
        </div>
        <div class="input-field">
            <label for="customer_email">Email<span>*</span></label>
            <input required type="text" name="customer_email" id="customer_email" placeholder="Podaj adres email" v-model="formData.customer_email">
        </div>
        <div class="input-field">
            <label for="customer_telephone">Telefon <span>*</span></label>
            <input required type="text" name="customer_telephone" id="customer_telephone" placeholder="Podaj telefon komórkowy (bez kierunkowego)" v-model="formData.customer_telephone">
        </div>
    </div>

    <div id="step2" class="form-inner lightSpeedIn step-container" data-step-number="2">
        <h1>Krok 2</h1>
        <h3>Dane firmy belgijskiej:</h3>
        <div class="input-field">
            <label for="belgian_nip">NIP firmy belgijskiej<span>*</span></label>
            <input type="text" id="belgian_nip" name="belgian_nip" placeholder="Podaj nr belgijskiego pracodawcy składający się z 10 cyfr" v-model="formData.belgian_nip">
        </div>
        <div class="input-field">
            <label for="belgian_company_telephone">Telefon firmy</label>
            <input type="text" id="belgian_company_telephone" name="belgian_company_telephone" placeholder="Podaj tel belgijskiego kontrahenta składający się wyłącznie z cyfr" v-model="formData.belgian_company_telephone">
        </div>
        <div class="input-field">
            <label for="belgian_company_email">Email firmy</label>
            <input type="text" id="belgian_company_email" name="belgian_company_email" placeholder="Podaj email belgijskiego kontrahenta" v-model="formData.belgian_company_email">
        </div>
        <div class="input-field">
            <label for="sector">Branża<span>*</span></label>
            <v-select :items="items" name="sector" v-model="formData.sector"></v-select>
        </div>
        <div class="input-field">
            <label for="start_date">Data startu pracy<span>*</span></label>
            <input type="date" id="start_date" name="start_date" v-model="formData.start_date">
        </div>
        <div class="input-field">
            <label for="end_date">Data końca pracy<span>*</span></label>
            <input type="date" id="end_date" name="end_date" v-model="formData.end_date">
        </div>
    </div>
    <div id="step3" class="form-inner lightSpeedIn step-container" data-step-number="3">
        <h1>Krok 3</h1>
        <h3>Miejsca wykonywania działalności</h3>

        <v-fade-transition hide-on-leave>
            <v-card
                v-show="dialog"
                title="Wpowadź NIP"
                variant="text"
            >
                <v-form id="nip_place_of_work_form">
                    <div class="nip-info-group" v-for="(nip, index) in formData.nips">
                        <div class="input-field">
                            <label for="nip_place_of_work[]">Nip </label>
                            <input type="text" class="nip_place_of_work" :name="'nip_place_of_work[' + index + ']'" v-model="nip.title" placeholder="NIP">
                        </div>
                    </div>
                </v-form>
                <v-divider inset></v-divider>
                <div class="pa-4 text-end">
                    <v-btn
                        class="text-none"
                        color="medium-emphasis"
                        min-width="92"
                        rounded
                        variant="outlined"
                        @click="cancelNipEdit"
                    >
                        Anuluj
                    </v-btn>
                    <v-btn
                        class="text-none"
                        color="medium-emphasis"
                        min-width="92"
                        rounded
                        variant="outlined"
                        @click="storeNip"
                    >
                        Dodaj
                    </v-btn>
                </div>
            </v-card>
        </v-fade-transition>
        <v-fade-transition hide-on-leave>
            <v-card
                v-show="addressDialog"
                title="Wpowadź adres"
                variant="text"
            >
                <v-form id="site_address_form">
                    <div class="address-info-group" v-for="(address, index) in formData.addresses">
                        <div class="input-field">
                            <label for="site_address[][]">Nazwa </label>
                            <input type="text" :name="'site_address[' + index + '][name]'" v-model="address.name" placeholder="Nazwa">
                        </div>
                        <div class="input-field">
                            <label for="site_address[][]">Ulica </label>
                            <input type="text" :name="'site_address[' + index + '][street]'" v-model="address.street" placeholder="Ulica">
                        </div>
                        <div class="input-field">
                            <label for="site_address[][]">Numer domu</label>
                            <input type="text" :name="'site_address[' + index + '][house_number]'" v-model="address.house_number" placeholder="Numer domu">
                        </div>
                        <div class="input-field">
                            <label for="site_address[][]">Nr mieszkania</label>
                            <input type="text" :name="'site_address[' + index + '][apartment_number]'" v-model="address.apartment_number" placeholder="Numer mieszkania">
                        </div>
                        <div class="input-field">
                            <v-combobox
                                :name="'site_address[' + index + '][postcode]'"
                                label="Kod pocztowy i miasto"
                                :items="{!! $postcodes !!}"
                                v-model="address.postcode"
                            ></v-combobox>
                        </div>
                        <v-divider inset></v-divider>
                    </div>

                </v-form>
                <div class="pa-4 text-end">
                    <v-btn
                        class="text-none"
                        color="medium-emphasis"
                        min-width="92"
                        rounded
                        variant="outlined"
                        @click="cancelAddressEdit"
                    >
                        Anuluj
                    </v-btn>
                    <v-btn
                        class="text-none"
                        color="medium-emphasis"
                        min-width="92"
                        rounded
                        variant="outlined"
                        @click="storeAddress"
                    >
                        Dodaj
                    </v-btn>
                </div>
            </v-card>
        </v-fade-transition>
        <v-card
            class="mx-auto"
            max-width="600"
            variant="text"
        >
            <v-list bg-color="transparent" lines="one" variant="plain">
                <v-list-item
                    v-for="(nip, index) in formData.nips"
                    :key="nip.title"
                    :title="nip.title"
                >
                    <template v-slot:prepend>
                        <v-avatar :color="'purple'" icon="mdi-clipboard-text"></v-avatar>
                    </template>

                    <template v-slot:append>
                        <v-btn
                            color="grey-lighten-1"
                            icon="mdi-close"
                            variant="text"
                            @click="deleteNip(index)"
                        ></v-btn>
                    </template>

                </v-list-item>

                <v-list-subheader inset><v-btn
                        v-if="!dialog && count < 5"
                        size="x-medium"
                        color="purple"
                        @click="addForm"
                    >
                        Dodaj miejsce pracy po belgijskim NIP
                    </v-btn>
                </v-list-subheader>

                <v-divider inset></v-divider>

                <v-list-item
                    v-for="(address, index) in formData.addresses"
                    :key="address.name"
                    :title="address.name"
                    :subtitle="address.street + ' ' + address.house_number + ' ' + address.postcode.title"
                >
                    <template v-slot:prepend>
                        <v-avatar :color="'blue'" icon="mdi-factory"></v-avatar>
                    </template>

                    <template v-slot:append>
                        <v-btn
                            color="grey-lighten-1"
                            icon="mdi-close"
                            variant="text"
                            @click="deleteAddress(index)"
                        ></v-btn>
                    </template>
                </v-list-item>

                <v-list-subheader inset>
                    <v-btn
                        v-if="!dialog && count < 5"
                        size="x-medium"
                        color="blue"
                        @click="newAddressForm"
                    >
                        Dodaj adres miejsca pracy
                    </v-btn>
                </v-list-subheader>
            </v-list>
        </v-card>
        <v-alert
            v-if="!dialog && count >= 5"
            density="compact"
            type="warning"
            title="Podałeś maksymalną ilość adresów"
        ></v-alert>

    </div>
    <div id="step4" class="form-inner lightSpeedIn step-container" data-step-number="4">
        <h1>Krok 4</h1>
        <h3>Dane identyfikacyjne firmy:</h3>
        <div class="input-field">
            <label for="nip">NIP <span>*</span></label>
            <input required type="text" name="nip" id="nip" placeholder="Wpisz NIP składający się z 10 cyfr" v-model="formData.nip">
        </div>
        <div class="input-field">
            <label for="pesel">PESEL <span>*</span></label>
            <input required type="text" name="pesel" id="pesel" placeholder="Wpisz PESEL składający się z 11 cyfr" v-model="formData.pesel">
        </div>
        <div class="input-field">
            <label>Ulica <span>*</span></label>
            <input required type="text" name="street" id="street" placeholder="Wpisz ulicę" v-model="formData.street">
        </div>
        <div class="input-field">
            <label for="house_number">Nr domu <span>*</span></label>
            <input required type="text" id="house_number" name="house_number" placeholder="Wpisz nr domu" v-model="formData.house_number">
        </div>
        <div class="input-field">
            <label for="flat_number">Nr mieszkania</label>
            <input type="text" id="flat_number" name="flat_number" placeholder="Wpisz nr mieszkania" v-model="formData.flat_number">
        </div>
        <div class="input-field">
            <label for="postcode">Kod pocztowy<span>*</span></label>
            <input required type="text" id="postcode" name="postcode" placeholder="Wpisz kod pocztowy w formacie 00-000" v-model="formData.postcode">
        </div>
        <div class="input-field">
            <label for="city">Miasto<span>*</span></label>
            <input required type="text" id="city" name="city" placeholder="Wpisz miasto" v-model="formData.city">
        </div>
    </div>
    <div id="step5" class="form-inner lightSpeedIn step-container" data-step-number="5">
        <h1>Krok 5</h1>
        <h3>Wymagane zgody oraz język otrzymanej limosy</h3>
        <div class="check-field">
            <label>Język wygenerowanej limosy</label>
            <div class="row">
                <div class="tab-100 col-md-6">
                    <div class="check-single">
                        <input type="checkbox" name="limosalanguage[en]" value="true">
                        <label>Angielski</label>
                    </div>
                    <div class="check-single">
                        <input type="checkbox" name="limosalanguage[fr]" value="true">
                        <label>Francuski</label>
                    </div>
                    <div class="check-single">
                        <input type="checkbox" name="limosalanguage[nl]" value="true">
                        <label>Niderlandzki</label>
                    </div>
                    <div class="check-single">
                        <input type="checkbox" name="limosalanguage[de]" value="true">
                        <label>Niemiecki</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="check-field">
            <label>Wymagane zgody</label>
            <div class="row">
                <div class="tab-100 col-md-12">
                    <div class="check-single">
                        <input type="checkbox" name="dataagreement[all]" value="true">
                        <label>Zaznacz wszystkie</label>
                    </div>
                    <div class="check-single">
                        <input type="checkbox" name="dataagreement[rodo]" value="true">
                        <label>Zgoda na przetwarzanie danych osobowych do celów wygenerowania limosy<span>*</span></label>
                    </div>
                    <div class="check-single">
                        <input type="checkbox" name="dataagreement[marketing]" value="true">
                        <label>Zgoda na przetwarzanie danych do celów marketingowych</label>
                    </div>
                    <div class="check-single">
                        <input type="checkbox" name="dataagreement[newsletter]" value="true">
                        <label>Newsletter</label>
                    </div>
                </div>
            </div>
        </div>
        <div><span>*</span> Zgoda wymagana</div>
    </div>
    <div class="submit" >

        <button class="next-step-btn" @click="paginate">
            <img class='loader' src='images/loading.gif' style="display: none">
            Zapisz i przejdź dalej
            <span><i class="fa-solid fa-thumbs-up"></i></span>
        </button>
        <button type="submit" id="sub" style="display:none;">
            <img class='loader' src='images/loading.gif' style="display: none">
            Generuj Limosę
            <span><i class="fa-solid fa-thumbs-up"></i></span>
        </button>
    </div>
</form>
