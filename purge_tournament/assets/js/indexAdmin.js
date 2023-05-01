function loadAllMessagesInAdminIndex() {
    let messagesTable = document.getElementById("messages-table").querySelector("tbody");

    fetch('https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/contacts')
        .then(response => response.json())
        .then(messages => {
            messages.forEach(message => {
                let tr = document.createElement("tr");
                let tdName = document.createElement("td");
                let tdEmail = document.createElement("td");
                let tdMessage = document.createElement("td");
                let tdDelete = document.createElement("td");
                let deleteBtn = document.createElement("button");
                let deleteLink = document.createElement("a");

                tdName.textContent = decodeHTMLEntities(message.name);
                tdEmail.textContent = decodeHTMLEntities(message.email);
                tdMessage.textContent = decodeHTMLEntities(message.message);

                deleteLink.textContent = "Supprimer";
                deleteLink.href = `https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/contacts/${message.id}/delete`;
                deleteBtn.classList.add("delete-message-btn");
                deleteBtn.appendChild(deleteLink);
                tdDelete.appendChild(deleteBtn);

                tr.appendChild(tdName);
                tr.appendChild(tdEmail);
                tr.appendChild(tdMessage);
                tr.appendChild(tdDelete);

                messagesTable.appendChild(tr);
            });
        })
}

function decodeHTMLEntities(text) {
    let textArea = document.createElement('textarea');
    textArea.innerHTML = text;
    return textArea.value;
}

window.addEventListener('DOMContentLoaded', loadAllMessagesInAdminIndex);
