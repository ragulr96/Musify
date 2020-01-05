<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content contact-content" style="width: 750px; margin-left: -125px;">
			<div class="modal-header contact-header">
				<h3>Contacts</h3>
			</div>
			<div class="modal-body">
				<div class="form-group searchContact">
					<label for="exampleSelect1">Search Contact List</label>

					<select class="form-control" id="searchUser" name="searchUser" style="width: 330px;"
							name="searchContactByTag" id="searchContactByTag">
						<option value="" selected disabled>Search contact by tag</option>
						<option value="family">Family</option>
						<option value="friend">Friend</option>
						<option value="work">Work</option>
						<option value="school">School</option>
					</select>

					<input type="text" class="form-control" name="searchContactByName" id="searchContactByName"
						   placeholder="Search Contact by Last name"
						   style="width: 330px; margin-top: -46px; margin-left: 345px;">

					<button class="btn searchUser-btn"><i class="fa fa-search fa-2x"></i></button>
					<hr>

				</div>

				<div class="table-responsive">
					<div id="contactData">
						<table class="table table-hover table-sm contact-table">
						</table>
					</div>
				</div>
				<br>
			</div>
			<div class="modal-footer">
				<button type="submit" class="addContact-btn" id="addContact">New Contact</button>
			</div>
		</div>
	</div>
</div>

<div id="addContactModel" style="display: none">
	<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content signup-content">
				<div class="modal-header signup-header">
					<h3>Create New Contact</h3>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-5">
							<input type="text" class="form-control" name="firstName" id="firstName"
								   placeholder="First name">
						</div>

						<div class="col-md-7">
							<input type="text" class="form-control" name="lastName" id='lastName'
								   placeholder="Last name">
						</div>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="email" id="email" placeholder="Email">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="telephoneNo" id="telephoneNo"
							   placeholder="Telephone Number">
					</div>

					<button type="submit" class="btn btn-primary btn-block" id="createContact" name="createContact">
						Create
						Contact
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="editContactModel" style="display: none;">
	<div id="myModal" class="modal d-block position-relative" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content signup-content">
				<div class="modal-header signup-header">
					<h3>Update Contact</h3>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-5">
							<input type="text" class="form-control" name="editFirstName" id="editFirstName"
								   placeholder="First name">
						</div>

						<div class="col-md-7">
							<input type="text" class="form-control" name="editLastName" id='editLastName'
								   placeholder="Last name">
						</div>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="editEmail" id="editEmail" placeholder="Email">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="editTelephoneNo" id="editTelephoneNo"
							   placeholder="Telephone Number">
						<input type="hidden" class="form-control" name="editContactId" id="editContactId">
					</div>

					<div class="form-group">
						<label>Contact Tags</label>
						<select multiple="multiple" class="form-control" name="contactTags"
								id="contactTags">
							<option value="family">Family</option>
							<option value="friend">Friend</option>
							<option value="work">Work</option>
							<option value="school">School</option>
						</select>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="editDisplayPictureUrl" id="editDisplayPictureUrl"
							   placeholder="Display Picture Url">
					</div>

					<div class="updateContactDiv">
						<button type="submit" class="btn btn-primary btn-block updateContact-btn" id="updateContact" name="updateContact">
							Update Contact
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	/**
	 * on click function to load the add contact model
	 */
	$(document).ready(function () {
		$("#addContact").click(function (event) {
			event.preventDefault();

			$("#addContactModel").show();
			$("#editContactModel").hide();

		});
	});


	/**
	 ******************************************************************************************GET
	 */

	// var Contact = Backbone.Model.extend({
	// 	urlRoot: "http://localhost/Musify/index.php/contactApi/contact",
	// 	defaults: {
	// 		contactId: "",
	// 		firstName: "",
	// 		lastName: "",
	// 		email: "",
	// 		telephoneNo: "",
	// 		displayPictureUrl: "",
	// 	},
	//
	// 	idAttribute: 'contactId'
	// });

	//var Contacts = Backbone.Collection.extend({
	//	model: Contact,
	//	url: "<?php //echo site_url(); ?>///contactApi/contact"
	//});
	//
	//var contacts = new Contacts();
	//contacts.fetch({
	//	data: {
	//		lastName: 'a',
	//		tag: 'family'
	//	}, success: function (response) {
	//		console.log(response);
	//	}
	//});

	/**
	 ******************************************************************************************ADD
	 */

	// var contact = new Contact();
	//
	// var contactDetails = {
	// 	firstName: "Ragul",
	// 	lastName: 'Ravindira',
	// 	email: 'unicodeveloper@gmail.com',
	// 	telephoneNo: 1234
	// };
	//
	// contact.save(contactDetails, {
	// 	success: function (user) {
	// 		alert(JSON.stringify(user));
	// 	}
	// });


	/**
	 ******************************************************************************************UPDATE
	 */
	// var contact1 = new Contact();
	//
	// contact1.fetch({
	// 	data: {
	// 		lastName: 'a'
	// 	}, success: function (response) {
	// 		console.log(response);
	// 	}
	// });
	//
	// contact1.save({
	// 	contactId: "121",
	// 	firstName: "RagullRagul",
	// 	lastName: 'Ravindira',
	// 	email: 'unicodeveloper@gmail.com',
	// 	telephoneNo: "1234",
	// 	displayPictureUrl: "https://www.facebook.com",
	// 	contactTags: "family,school,work"
	// }, {
	// 	success: function (model) {
	// 		alert(JSON.stringify(contact1));
	// 	}
	// });

	/**
	 ******************************************************************************************DELETE
	 */

		// var contact2 = new Contact();
		//
		// contact2.fetch({
		// 	data: {
		// 		lastName: 'l'
		// 	}, success: function (response) {
		// 		console.log(JSON.stringify(response));
		// 	}
		// });
		//
		// contact2.destroy();

		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		// create contact model
	var ContactModel = Backbone.Model.extend({

			urlRoot: "<?php echo site_url(); ?>/contactApi/contact",
			idAttribute: 'contactId',

			defaults: {
				firstName: '',
				lastName: '',
				email: '',
				telephoneNo: '',
				displayPictureUrl: '',
				contactTags: ''
			},

		});

	// create contact collection
	var ContactCollection = Backbone.Collection.extend(
		{
			model: ContactModel,
			url: "<?php echo site_url(); ?>/contactApi/contact",
		}
	);

	// create new ContactCollection object
	var contactCollections = new ContactCollection();

	// create contact view
	var ContactCreateView = Backbone.View.extend(
		{
			el: '#addContactModel',
			initialize: function () {

			},
			render: function () {
				return this;
			},
			events: {
				"click #createContact": 'createNewContact'
			},
			createNewContact: function () {

				console.log('creating contact model');

				var firstName = $('#firstName').val();
				var lastName = $('#lastName').val();
				var email = $('#email').val();
				var telephoneNo = $('#firstName').val();

				var contact = new ContactModel({
					firstName: firstName,
					lastName: lastName,
					email: email,
					telephoneNo: telephoneNo
				});
				contact.save();
				contactCollections.add(contact);
				$("#addContactModel").hide();
			}
		}
	);

	var contactAdd = new ContactCreateView();

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	var ContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('#contactData'),

			initialize: function () {

				contactCollections.fetch({async: false});
				this.render();
				this.model.on('add', this.render, this);
			},

			render: function () {

				var self = this;
				this.$el.empty();
				console.log(contactCollections);
				contactCollections.each(function (c) {

					var iteratedContent = `<tr class="table-light">
							<td style="width: 60px; height: 50px"><img class="" style="width: 40px; height: 40px" src=${c.get("displayPictureUrl")}></td>
							<td style="width: 80px; height: 50px">${c.get("firstName")}</td>
							<td style="width: 80px; height: 50px">${c.get("lastName")}</td>
							<td style="width: 150px; height: 50px">${c.get("email")}</td>
							<td style="width: 100px; height: 50px">${c.get("telephoneNo")}</td>
							<td style="width: 80px; height: 50px">
								<div class="editContact">
									<button type="submit" class="editContact-btn" id="${c.get("contactId")}"><i class="fa fa-edit fa-2x"></i></button>
								</div>
							</td>
							<td style="width: 80px; height: 50px">
								<div class="deleteContact">
									<button type="submit" class="deleteContact-btn" id="${c.get("contactId")}"><i class="fa fa-trash fa-2x"></i></button>
								</div>
							</td>
						</tr>`;
					self.$el.append(iteratedContent)
				});

			}
		}
	);

	var contactDisplayView = new ContactDisplayView();

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	var DeleteContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('.deleteContact'),

			initialize: function () {

				contactCollections.fetch({async: false});
				this.render();
			},

			events: {
				"click .deleteContact-btn": 'deleteExistingContact'
			},

			deleteExistingContact: function (event) {

				console.log('deleting contact model');
				console.log(event);

				var contact = new ContactModel({
					contactId: event.currentTarget.id
				});

				contact.destroy();
				contactCollections.remove(contact);

				var $tr = $(event.target).closest('tr');
				$tr.remove();

				$("#editContactModel").hide();
				$("#addContactModel").hide();
			}
		}
	);

	var contactDelete = new DeleteContactDisplayView();

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	var EditContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('.editContact'),

			initialize: function () {

				contactCollections.fetch({async: false});
				this.render();
			},

			render: function () {
				return this;
			},
			events: {
				"click .editContact-btn": 'editContactModel'
			},

			editContactModel: function (event) {

				$("#editContactModel").show();
				$("#addContactModel").hide();

				// console.log(event);

				var contactId = event.currentTarget.id;

				var con = contactCollections.get(contactId);

				var firstName = con.get('firstName');
				var lastName = con.get('lastName');
				var email = con.get('email');
				var telephoneNo = con.get('telephoneNo');
				var displayPictureUrl = con.get('displayPictureUrl');
				var contactId = con.get('contactId');

				$("input#editFirstName").val(firstName);
				$("input#editLastName").val(lastName);
				$("input#editEmail").val(email);
				$("input#editTelephoneNo").val(telephoneNo);
				$("input#editDisplayPictureUrl").val(displayPictureUrl);

				$("input#editContactId").val(contactId);


			}
		}
	);

	var contactEdit = new EditContactDisplayView();

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	var UpdateContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('.updateContactDiv'),

			initialize: function () {
				contactCollections.fetch({async: false});
				this.render();
			},

			render: function () {
				return this;
			},
			events: {
				"click .updateContact-btn": 'updateExistingContact',
			},

			updateExistingContact: function () {

				console.log('updating contact model');

				var contactId = $("input#editContactId").val();
				var firstName = $("input#editFirstName").val();
				var lastName = $("input#editLastName").val();
				var email = $("input#editEmail").val();
				var telephoneNo = $("input#editTelephoneNo").val();
				var displayPictureUrl = $("input#editDisplayPictureUrl").val();
				var contactTags = $('#contactTags').val();

				var contact = new ContactModel({
					contactId: contactId,
					firstName: firstName,
					lastName: lastName,
					email: email,
					telephoneNo: telephoneNo,
					contactTags: contactTags,
					displayPictureUrl: displayPictureUrl
				});

				console.log("update contact : " + JSON.stringify(contact));

				contact.save();
				contactCollections.add(contact);

				$("#ediContactModel").hide();
			}
		}
	);

	var contactUpdate = new UpdateContactDisplayView();

</script>
<?php
