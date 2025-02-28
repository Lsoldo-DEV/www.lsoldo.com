document.addEventListener('DOMContentLoaded', function() {
    // Toggle des commentaires
    const commentToggle = document.querySelector('.comment-toggle');
    const commentsSection = document.querySelector('.comments');
    const commentIcon = document.querySelector('.comment-icon');
    
    if(commentToggle && commentsSection) {
        commentToggle.addEventListener('click', function() {
            const isHidden = commentsSection.classList.toggle('d-none');
            
            // Changement d'icône
            if(commentIcon) {
                commentIcon.classList.toggle('bi-chat');
                commentIcon.classList.toggle('bi-chat-dots');
            }
            
            // Animation de défilement
            if(!isHidden) {
                setTimeout(() => {
                    commentsSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        });
    }

    // Mise à jour dynamique du compteur
    document.addEventListener('commentAdded', function(e) {
        const countElement = document.querySelector('.comment-count');
        if(countElement) {
            const newCount = parseInt(countElement.textContent) + 1;
            countElement.textContent = newCount;
            
            // Mise à jour du titre
            const commentTitle = document.querySelector('.comments h3');
            if(commentTitle) {
                commentTitle.textContent = `{{ 'comments'|trans }} (${newCount})`;
            }
        }
    });
});

				