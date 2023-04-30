function loadAllMessagesInAdminIndex() {
    let messagesTable = document.getElementById("messages-table").querySelector("tbody");

    fetch('https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/contacts')
        .then(response => response.json())
        .then(messages => {
            messages.forEach(message => {
                const tr = document.createElement("tr");
                const tdName = document.createElement("td");
                const tdEmail = document.createElement("td");
                const tdMessage = document.createElement("td");
                const tdDelete = document.createElement("td");
                const deleteBtn = document.createElement("button");
                const deleteLink = document.createElement("a");

                tdName.textContent = message.name;
                tdEmail.textContent = message.email;
                tdMessage.textContent = message.message;

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

window.addEventListener('DOMContentLoaded', function() {

    loadAllMessagesInAdminIndex();

});
