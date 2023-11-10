class Item {
    constructor(id, title, content, publication_date) {
        this.id = id;
        this.title = title;
        this.content = content;
        this.publication_date = publication_date;
    }
}

class ResponseObject {
    constructor() {
        this.news = [];
        this.page = 0;
        this.countPage = 0;
    }
}