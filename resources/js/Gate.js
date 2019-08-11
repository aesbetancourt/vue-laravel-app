export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'Administrador';
    }

    isUser(){
        return this.user.type === 'Estándar';
    }


}
