// ...existing code...

<!-- Add Email Icon to the header navigation -->
<li class="nav-item">
    <a class="nav-link" href="#" id="emailIcon">
        <div class="email-icon">
            <i class="fas fa-envelope"></i>
            <span class="email-badge" id="emailBadge">0</span>
        </div>
    </a>
</li>

// ...existing code...

<!-- Add Email Modal -->
<div id="emailModal" class="email-modal">
    <div class="email-modal-content">
        <div class="email-modal-header">
            <span class="email-modal-title">Email System</span>
            <span class="close-email-modal">&times;</span>
        </div>
        
        <div class="email-tabs">
            <div class="email-tab active" data-view="composeEmail">Compose</div>
            <div class="email-tab" data-view="emailList">Sent Emails</div>
        </div>
        
        <div class="email-view active" id="composeEmail">
            <form id="emailForm" class="email-form">
                <div class="email-form-group">
                    <label for="recipient">To:</label>
                    <input type="email" id="recipient" name="recipient" required>
                </div>
                
                <div class="email-form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                
                <div class="email-form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <div class="email-form-group">
                    <label for="attachment">Attachment:</label>
                    <input type="file" id="attachment" name="attachment">
                </div>
                
                <div class="email-actions">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
        
        <div class="email-view" id="emailList">
            <div id="emailListContent">
                <!-- Emails will be loaded here -->
            </div>
        </div>
        
        <div class="email-view" id="emailView">
            <!-- Selected email will be displayed here -->
        </div>
    </div>
</div>

// ...existing code...
