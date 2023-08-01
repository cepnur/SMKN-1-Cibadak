import httpClient from './httpClient';
import axios from 'axios';

export default class Posts {
  static getLatestPosts() {
    return httpClient.get('/posts/latest');
  }

  static fetchPostRegulations(formData) {
    return httpClient.post('/regulations/getdata', formData);
  }

  static latestGalleries() {
    return httpClient.get('/gallery/latest');
  }

  static fetchPostGalleries(formData) {
    return httpClient.post('/gallery/getdata', formData);
  }

  static fetchPosts(formData) {
    return httpClient.post('/posts/getdata', formData);
  }
  static fetchSearch(formData) {
    return httpClient.post('/posts/search', formData);
  }
}