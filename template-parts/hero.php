<main class="bg-dotted py-7 md:py-16">
  <div class="max-w-screen-xl animate__backInDown mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
    <div class="md:w-1/2 space-y-4">
      <h1 class="md:text-4xl text-2xl font-bold text-black">
        Unlock the Secrets to Targeting Your Ideal Real Estate Audience on Social Media
      </h1>
      <p class="text-lg text-black" id="EmailForm">
        Discover 100 powerful audience targeting strategies rigorously tested and proved to boost your real estate ads' effectiveness for totally free.
      </p>

      <div class="mt-8">
        <!-- Button to trigger modal -->
        <button id="openModalButton" class="bg-red-500 py-5 rounded animate__rubberBand animate__backInDown">
          <span class="text-md md:text-xl text-white p-4">Download Your Free Guide Now</span>
        </button>
      </div>
    </div>

    <div class="md:w-1/2 mt-8 md:mt-0 flex justify-center md:px-8">
      <img src="https://olayemiolamiju.com/wp-content/uploads/2024/06/ADS-Market-copy-mockup-scaled.webp" alt="Book Image" class="object-center w-full rounded" loading="lazy" />
    </div>
  </div>
  <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-dotted p-6 rounded-lg shadow-lg w-96">
      <h2 class="text-2xl font-bold mb-4">Enter Your Details</h2>
      <form id="modalForm" class="space-y-4" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <input type="hidden" name="action" value="submit_form">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" id="name" name="name" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Enter your full name" required>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Enter your active email address" required>
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
          <div class=" ">
            <input type="hidden" id="countryCode" name="countryCode">
            <input type="tel" id="phone" name="phone" class="block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Enter your phone number" required>

          </div>
        </div>


        <div id="validationMessage" class="text-red-500 text-sm hidden"></div> <!-- Validation message -->
        <div class="flex justify-end">
          <button type="button" id="closeModalButton" class="mr-2 bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
          <button type="submit" name="submit" class="bg-greyish border border-green-200 text-black py-2 px-4 rounded">Submit</button>
        </div>
      </form>
    </div>
  </div>
</main>