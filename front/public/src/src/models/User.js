class User {
    constructor(id, name, email, emailVerified, createdAt) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.emailVerified = emailVerified;
        this.createdAt = new Date(createdAt); // Преобразовываем строку в объект Date
    }

    // Метод для получения длительности существования пользователя в системе
    getDuration() {
        const currentTime = new Date();
        const diffMilliseconds = currentTime - this.createdAt;
        const diffSeconds = Math.floor(diffMilliseconds / 1000);
        const diffMinutes = Math.floor(diffSeconds / 60);
        const diffHours = Math.floor(diffMinutes / 60);
        const diffDays = Math.floor(diffHours / 24);

        return {
            days: diffDays,
            hours: diffHours % 24,
            minutes: diffMinutes % 60,
            seconds: diffSeconds % 60,
        };
    }
}