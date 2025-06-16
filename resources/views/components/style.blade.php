<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholar Hub</title>
    <style>
           body {
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
        url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    font-family: 'Segoe UI', sans-serif;
}



        header {
            background-color: rgb(250, 250, 250); /* blue-700 */
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        span {
            color: rgb(24, 21, 21)
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
        }


        .login-btn {
    padding: 7px 18px;
    margin-left: 10px;
    background: #ffffff;
    color: #272020;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s;
    border: 1px solid #ccc; /* light gray border */
    }

        .login-btn:hover {
            background: #e0e7ff;
        }

        .register-btn {
            padding: 7px 18px;
            margin-left: 10px;
            background: rgb(39, 32, 32);
            color: rgb(223, 211, 211);
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }

        .register-btn:hover {
            background: #e0e7ff;
        }

        .welcome-heading {
             text-align: center;
        margin-top: 60px;
        font-size: 3rem;
        font-weight: bold;
        color: #1e293b;
        }

        .welcome-text {
    text-align: center;
    font-size: 1.3rem;
    color: #4b5563; /* Tailwind slate-600 */
    max-width: 600px;
    margin: 20px auto;
    line-height: 1.6;
}

.start-btn-wrapper {
    display: flex;
    justify-content: center;
     gap: 20px;
    margin-top: 30px;
}

 .start-btn {

    justify-content: center;
    padding: 14px 36px;
    background: rgb(39, 32, 32);
    color: rgb(255, 255, 255);
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: background 0.3s;

}

 .sign-btn {
    justify-content: center;
    padding: 14px 36px;
    background: rgb(255, 255, 255);
    color: rgb(39, 32, 32);
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: background 0.3s;
    border: 1px solid #ccc;

 }

 .features-nav {
     display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 1.5rem;
    margin: 40px auto;
    padding: 0 20px;
    max-width: 1000px;

}

.feature-item {
    background: #ffffff;
    padding: 20px;
    width: 300px; /* fixed width for consistent card size */
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    font-size: 0.95rem;
    color: #1e293b;
    transition: transform 0.3s;
    border: 1px solid #ccc;
    text-align: center; /* Center all content */
    display: flex;
    flex-direction: column;
    align-items: center;
}

.feature-item .feature-icon {
    display: block;
    margin: 0 auto 10px auto; /* Center image above title */
    width: 40px;
    height: 40px;
}

.feature-item strong {
    display: block;
    font-size: 1.2rem;
    margin-bottom: 8px;
    color: #111827;
    margin-top: 0;
}

.feature-item p {
    margin-top: 10px;
    font-size: 0.95rem;
    color: #4b5563;
    text-align: center;
}

.feature-item:hover {
    transform: translateY(-5px);
}

.feature-icon {
     width: 24px;
  height: 24px;
  margin-left: 0.5rem;
}

.user-access-nav {
    background-color: #f9fafb;
    padding: 50px 20px;
    margin-top: 40px;
    text-align: center;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.second-heading {
    font-size: 1.8rem;
    color: #0f172a;
    font-weight: 700;
    margin-bottom: 30px;
}

.second-nav {
    display: flex;
    justify-content: center;
    gap: 2.5rem;
    flex-wrap: wrap;
}

.second-item {
    width: 260px;
    padding: 20px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.second-item:hover {
    transform: translateY(-6px);
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px auto;
}

.second-icon {
    width: 30px;
    height: 30px;
}

.green-bg {
    background-color: #d1fae5;
}

.purple-bg {
    background-color: #ede9fe;
}

.red-bg {
    background-color: #fee2e2;
}

.second-item strong {
    font-size: 1.1rem;
    display: block;
    margin-bottom: 10px;
    color: #111827;
}

.second-item p {
    font-size: 0.9rem;
    color: #4b5563;
}
.navbar {
  background: #2c3e50; /* Example background */
  padding: 16px 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
}

.nav-img {
  flex-shrink: 0;
  margin-right: 12px;
}

.nav-text {
  display: flex;
  align-items: center;
  justify-content: center; /* Center title and paragraph horizontally */
}

.nav-title {
  font-size: 1.5rem;
  font-weight: bold;
  color: #fff;
  margin-bottom: 4px;
}

.p-nav {
  font-size: 1rem;
  color: #ecf0f1;
  margin: 0;
  text-align: center;
  margin-top: 4px;
}









    </style>
</head>
<body>


    <main>
        {{ $slot }}
    </main>
</body>
</html>
