document.addEventListener('DOMContentLoaded', function() {
    // Email icon click handler
    const emailIcon = document.getElementById('emailIcon');
    if (emailIcon) {
        emailIcon.addEventListener('click', function() {
            document.getElementById('emailModal').style.display = 'block';
            loadEmails();
        });
    }

    // Close modal when clicking the close button
    const closeButton = document.querySelector('.close-email-modal');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            document.getElementById('emailModal').style.display = 'none';
        });
    }

    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('emailModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Tab switching
    const tabs = document.querySelectorAll('.email-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const view = this.getAttribute('data-view');
            
            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Update active view
            document.querySelectorAll('.email-view').forEach(v => v.classList.remove('active'));
            document.getElementById(view).classList.add('active');
            
            if (view === 'emailList') {
                loadEmails();
            }
        });
    });

    // Email form submission
    const emailForm = document.getElementById('emailForm');
    if (emailForm) {
        emailForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(emailForm);
            
            fetch('/api/send_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Email sent successfully');
                    emailForm.reset();
                    
                    // Switch to sent emails tab
                    document.querySelector('[data-view="emailList"]').click();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending the email');
            });
        });
    }

    // Load emails function
    function loadEmails(page = 1) {
        const emailList = document.getElementById('emailListContent');
        if (!emailList) return;

        emailList.innerHTML = '<p>Loading emails...</p>';
        
        fetch(`/api/get_emails.php?page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data.length > 0) {
                    let html = '<ul class="email-list">';
                    
                    data.data.forEach(email => {
                        html += `
                            <li class="email-item" data-id="${email.id}">
                                <div class="email-item-header">
                                    <span class="email-sender">${email.recipient}</span>
                                    <span class="email-date">${formatDate(email.sent_date)}</span>
                                </div>
                                <div class="email-subject">${email.subject}</div>
                                <div class="email-preview">${truncateText(email.message, 50)}</div>
                            </li>
                        `;
                    });
                    
                    html += '</ul>';
                    
                    // Add pagination if needed
                    if (data.data.length >= data.limit) {
                        html += `
                            <div class="email-pagination">
                                <button onclick="loadEmails(${data.page - 1})" ${data.page <= 1 ? 'disabled' : ''}>Previous</button>
                                <span>Page ${data.page}</span>
                                <button onclick="loadEmails(${data.page + 1})">Next</button>
                            </div>
                        `;
                    }
                    
                    emailList.innerHTML = html;
                    
                    // Add click event for email items
                    document.querySelectorAll('.email-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const emailId = this.getAttribute('data-id');
                            viewEmail(emailId);
                        });
                    });
                } else {
                    emailList.innerHTML = '<p>No emails found.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                emailList.innerHTML = '<p>Error loading emails.</p>';
            });
    }

    // View specific email
    function viewEmail(emailId) {
        const formData = new FormData();
        formData.append('email_id', emailId);
        
        fetch('/api/get_emails.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const email = data.data;
                const emailView = document.getElementById('emailView');
                
                emailView.innerHTML = `
                    <div class="email-content">
                        <h3>${email.subject}</h3>
                        <div class="email-metadata">
                            <p><strong>From:</strong> ${email.sender}</p>
                            <p><strong>To:</strong> ${email.recipient}</p>
                            <p><strong>Date:</strong> ${formatDate(email.sent_date)}</p>
                        </div>
                        <div class="email-body">
                            ${email.message.replace(/\n/g, '<br>')}
                        </div>
                        ${email.attachment ? `
                            <div class="email-attachment">
                                <p><strong>Attachment:</strong> <a href="/uploads/emails/${email.attachment}" target="_blank">${email.attachment.split('_').slice(1).join('_')}</a></p>
                            </div>
                        ` : ''}
                    </div>
                `;
                
                // Switch to email view
                document.querySelectorAll('.email-view').forEach(v => v.classList.remove('active'));
                emailView.classList.add('active');
            } else {
                alert('Error loading email details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while loading the email');
        });
    }

    // Helper functions
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleString();
    }

    function truncateText(text, maxLength) {
        if (text.length <= maxLength) return text;
        return text.substr(0, maxLength) + '...';
    }

    // Make these functions available globally
    window.loadEmails = loadEmails;
    window.viewEmail = viewEmail;
});
