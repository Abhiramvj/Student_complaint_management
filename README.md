# 🎓 Student Complaint Management System

A web-based platform where students can submit feedback or complaints to specific school/college departments. Admins and department heads can view, respond to, and resolve issues. Students receive real-time email updates and can track the status of their submissions.

---

## 💡 Core Features

### 👥 User Roles
- **Student:** Submit and track complaints/feedback  
- **Department Head:** Manage and resolve assigned complaints  
- **Admin:** Oversee all complaints and assign them to departments  

### 📝 Complaint Submission (Blade + AJAX)
- Students select the department and describe their issue  
- Complaints submitted via AJAX for a seamless experience  

### 📊 Complaint Management (MySQL + Joins)
- Admins assign complaints to relevant departments  
- Efficient data handling with table joins (complaints, departments, users)  
- Filter complaints by department, status, or student  

### 📧 Email Notification (Mail + Jobs)
- Automated email alerts sent to students and departments on submission or update  
- Uses queued jobs for efficient email delivery  

### 📈 Dashboards
- **Student Dashboard:** View complaint status and replies  
- **Admin Dashboard:** Monitor and manage all complaints  
- **Department Dashboard:** Handle assigned complaints  
