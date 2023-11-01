<!DOCTYPE html>
<html>
<head>
    <title>Limosa Registration</title>
</head>
<body>
<h1>Limosa Registration</h1>

<form method="POST" action="{{ route('form.register') }}">
    @csrf

    <!-- Personal Information -->
    <label for="full_name">Full Name</label>
    <input type="text" id="full_name" name="full_name" required>

    <label for="date_of_birth">Date of Birth</label>
    <input type="date" id="date_of_birth" name="date_of_birth" required>

    <label for="nationality">Nationality</label>
    <input type="text" id="nationality" name="nationality" required>

    <!-- Business Information -->
    <label for="business_name">Business Name (if applicable)</label>
    <input type="text" id="business_name" name="business_name">

    <label for="business_address">Business Address</label>
    <input type="text" id="business_address" name="business_address">

    <label for="business_contact">Business Contact Information</label>
    <input type="text" id="business_contact" name="business_contact">

    <!-- Purpose of Stay -->
    <label for="purpose_of_stay">Purpose of Stay</label>
    <select id="purpose_of_stay" name="purpose_of_stay" required>
        <option value="work">Work</option>
        <option value="self-employment">Self-Employment</option>
        <!-- Add more options as needed -->
    </select>

    <!-- Duration of Stay -->
    <label for="start_date">Start Date</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">End Date</label>
    <input type="date" id="end_date" name="end_date" required>

    <!-- Social Security Information -->
    <label for="social_security">Social Security Information</label>
    <input type="text" id="social_security" name="social_security" required>

    <!-- Bank Account Details -->
    <label for="bank_account">Bank Account Details</label>
    <input type="text" id="bank_account" name="bank_account" required>

    <!-- Contract Information -->
    <label for="contract_name">Contract Name</label>
    <input type="text" id="contract_name" name="contract_name" required>

    <label for="work_description">Work Description</label>
    <textarea id="work_description" name="work_description" required></textarea>

    <label for="contract_duration">Contract Duration</label>
    <input type="text" id="contract_duration" name="contract_duration" required>

    <!-- Submit Button -->
    <button type="submit">Submit</button>
</form>
</body>
</html>
