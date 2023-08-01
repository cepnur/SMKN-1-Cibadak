import httpClient from './httpClient';
import axios from 'axios';

export default class Users {
	static register( formData ) {
		return httpClient.post( '/user/register', formData );
	}

	static loginUser( formData ) {
		return httpClient.post( '/user/login', formData );
	}

	static logoutUser() {
		return httpClient.get( '/user/logout' );
	}

	static doAction( formData ) {
		const inputFile = document.getElementById('formFile');
		let uploadFile = inputFile.files[ 0 ];

		let params = new FormData();
		params.append( 'nim', formData.nim );
		params.append( 'nama', formData.nama );
		params.append( 'email', formData.email );
		params.append( 'sekolah', formData.sekolah );
		params.append( 'no_telepon', formData.no_telepon );
		params.append( 'tempat_lahir', formData.tempat_lahir );
		params.append( 'tanggal_lahir', formData.tanggal_lahir );
		params.append( 'mulai_magang', formData.mulai_magang );
		params.append( 'berakhir_magang', formData.berakhir_magang );
		params.append( 'alamat', formData.alamat );
		params.append( 'file', uploadFile );
		params.append( 'action', 'requestMagang' );
		params.append( 'security', document.getElementById( 'security' ).value );
		return axios.post( settings.ajax_url, params );
	}

	static updateProfile( formData ) {
		const params = new FormData();
		params.append( 'first_name', formData.first_name);
		params.append( 'last_name', formData.last_name);
		params.append( 'email', formData.email);
		params.append( 'phone_number', formData.phone_number );
		params.append( 'nik', formData.nik );
		params.append( 'action', 'updateUserProfile' );
		params.append( 'security', document.getElementById( 'security' ).value );
		return axios.post( settings.ajax_url, params );
	}

	static actionPengaduan( formData ) {
		const inputFile = document.getElementById('formFile');
		let uploadFile = inputFile.files[ 0 ];

		let params = new FormData();
		params.append( 'nama', formData.nama );
		params.append( 'email', formData.email );
		params.append( 'nik', formData.nik );
		params.append( 'subject', formData.subject );
		params.append( 'kategori', formData.kategori );
		params.append( 'pesan', formData.pesan );
		params.append( 'file', uploadFile );
		params.append( 'action', 'submitPengaduan' );
		params.append( 'security', document.getElementById( 'security' ).value );
		return axios.post( settings.ajax_url, params );
	}

	static addAction( formData ) {
		let params = new FormData();
		const inputFile = document.getElementById('formFile');
		let uploadFile = inputFile.files[ 0 ];
		for (const key in formData) {
			if (Object.hasOwnProperty.call(formData, key)) {
				params.append(key.toString(), formData[key]);
			}
		}
		params.append( 'file', uploadFile );
		params.append( 'security', document.getElementById( 'security' ).value );
		return axios.post( settings.ajax_url, params );
	}

	static findPassport( formData ) {
		return httpClient.post( '/user/find-passport', formData );
	}

	static updateDriveThru( formData ) {
		console.log(formData);
		return httpClient.post( '/user/update-passport', formData );
	}
}
