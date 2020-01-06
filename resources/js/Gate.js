export default class Gate{

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === 'admin'
    }

    isHk() {
        return this.user.type === 'housekeeping'
    }

}
