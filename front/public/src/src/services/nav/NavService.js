export const updateAvatarInNavMenu = (newAvatarUrl,name) => {
    const avatarElement = document.getElementById('nav_avatar');
    const account_avatar = document.getElementById('account_avatar');

        const randomString = Math.random().toString(36).substring(7);
        const newAvatarUrlWithRandom = newAvatarUrl + '?' + randomString;
        avatarElement.src = newAvatarUrlWithRandom;
        account_avatar.src = newAvatarUrlWithRandom;
};

export const updateNameInNavMenu = (name) => {
    const nav_name = document.getElementById('nav_name');
    nav_name.textContent = name;
};

export const updateCountPosts = (categoryId) =>{

}
