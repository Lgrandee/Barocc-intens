                <form action="{{ route('customers.store') }}" method="POST" class="flex flex-col gap-4 bg-white p-6 rounded-lg w-full">
                    @csrf
                    <label for="name_company" class="font-semibold text-gray-700">Company Name:</label>
                    <input type="text" id="name_company" name="name_company" placeholder="company name"
                        class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-400" required>

                    <label for="contact_person" class="font-semibold text-gray-700">Contact Person:</label>
                    <input type="text" id="contact_person" name="contact_person" placeholder="contact person"
                        class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-400" required>

                    <label for="email" class="font-semibold text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" placeholder="email"
                        class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-400" required>

                    <label for="phone_number" class="font-semibold text-gray-700">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="phone number"
                        class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-400" required>

                    <label for="bkr_number" class="font-semibold text-gray-700">BKR Number:</label>
                    <input type="text" id="bkr_number" name="bkr_number" placeholder="bkr number"
                        class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-400" required>

                    <input type="submit" id="Submit" name="Submit" value="Add customer"
                        class="mt-4 bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300 cursor-pointer">
                </form>
