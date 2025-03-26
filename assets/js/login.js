function showNotification(message) {
    const container = document.getElementById("notif-container");

    // Create the notification element
    const notif = document.createElement("div");
    notif.classList.add("notif");
    notif.innerHTML = `<h1>${message}</h1>`;

    // Append to container
    container.appendChild(notif);

    // Hide after 3 seconds with a slow fade-out
    setTimeout(() => {
        notif.classList.add("hide");
        setTimeout(() => notif.remove(), 1500); // Remove after fade-out
    }, 1000);
}

let 