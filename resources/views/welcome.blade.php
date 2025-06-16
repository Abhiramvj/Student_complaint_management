<x-style>


    <header>
        <nav>
            <div class="logo">
            <img src="https://img.icons8.com/ios-filled/32/000000/graduation-cap.png" alt="Logo" height="32" width="32">
            <span>Scholar Hub</span>
        </div>
        <div>
            @include('components.sign-in')
        </div>
        </nav>
    </header>
    <h1 class="welcome-heading">Welcome To Scholar Hub</h1>
    <p class="welcome-text">Your comprehensive platform for student feedback and complaint management.
        Submit, track, and resolve issues efficiently with our modern system.
    </p>
    <div class="start-btn-wrapper">
        @guest
            <a href="/register" class="start-btn">Get Started</a>
        @endguest
    @include('components.sign-in')
    </div>
   <div class="features-nav">
  <div class="feature-item">
    <strong><img src="https://png.pngtree.com/png-clipart/20230814/original/pngtree-chat-box-icon-web-white-picture-image_7934472.png" alt="Easy Submission" class="feature-icon" />
        Easy Submission

    </strong>
    <p>Submit complaints and feedback with our intuitive form. Attach files and select departments effortlessly.</p>
  </div>
  <div class="feature-item">
    <img src="https://cdn-icons-png.flaticon.com/512/66/66163.png" alt="Real-Time Tracking" class="feature-icon" />
    <strong>Real-Time Tracking

    </strong>
    <p>Track your complaints in real-time. Get instant updates on status changes and responses.</p>
  </div>
  <div class="feature-item">
     <img src="https://cdn-icons-png.flaticon.com/512/8522/8522214.png" alt="Secure & Private" class="feature-icon" />
    <strong>Secure & Private

    </strong>
    <p>Your data is protected with enterprise-grade security. Role-based access ensures privacy.</p>
  </div>
</div>

<div class="user-access-nav">
    <h2 class="second-heading">Who Can Use Scholar Hub?</h2>
    <div class="second-nav">
        <div class="second-item">
            <div class="icon-wrapper green-bg">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Students" class="second-icon" />
            </div>
            <strong>Students</strong>
            <p>Submit complaints, track status, and receive updates on your issues.</p>
        </div>
        <div class="second-item">
            <div class="icon-wrapper purple-bg">
                <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Dept Heads" class="second-icon" />
            </div>
            <strong>Department Heads</strong>
            <p>Manage department-specific complaints and coordinate responses.</p>
        </div>
        <div class="second-item">
            <div class="icon-wrapper red-bg">
                <img src="https://cdn-icons-png.flaticon.com/512/3524/3524659.png" alt="Admins" class="second-icon" />
            </div>
            <strong>Administrators</strong>
            <p>Oversee all complaints, assign to departments, and ensure resolution.</p>
        </div>
    </div>
</div>
<div class="user-access-nav" style="margin-bottom: 48px;">
    <h2 class="second-heading">Why Choose Scholar Hub?</h2>
    <div class="second-nav">
        <div class="second-item">
            <div class="icon-wrapper blue-bg">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Benefits" class="second-icon" />
            </div>
            <strong>Streamlined Experience</strong>
            <p>Easy, secure, and efficient complaint management for all users.</p>
        </div>
        <div class="second-item">
            <div class="icon-wrapper orange-bg">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" alt="Support" class="second-icon" />
            </div>
            <strong>24/7 Support</strong>
            <p>Get help anytime with our dedicated support team.</p>
        </div>
        <div class="second-item">
            <div class="icon-wrapper teal-bg">
                <img src="https://cdn-icons-png.flaticon.com/512/1256/1256650.png" alt="Analytics" class="second-icon" />
            </div>
            <strong>Insightful Analytics</strong>
            <p>Access reports and analytics to improve institutional processes.</p>
        </div>
    </div>
</div>
<nav class="navbar">
    <div style="nav-text">
        <img src="https://img.icons8.com/ios-filled/32/ffffff/graduation-cap.png" alt="Logo" height="32" width="32" class="nav-img" style="">
        <span class="nav-title">Scholar Hub</span>
    </div>
    <p class="p-nav">Empowering educational institutions with efficient complaint management</p>
</nav>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.addEventListener('pageshow', function (event) {
        if (event.persisted || (window.performance && performance.navigation.type === 2)) {
            window.location.reload();
        }
    });
</script>


</x-style>
