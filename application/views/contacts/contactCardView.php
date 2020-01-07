<div id="myModal" class="modal d-block position-relative">
	<div class="modal-dialog">
		<div class="modal-content contact-content" style="width: 930px;; margin-left: -212px;">
			<div class="modal-header contact-header">
				<h3>Contacts</h3>
			</div>
			<div class="modal-body">
				<div class="form-group searchContact">
					<label for="exampleSelect1">Search Contact List</label>
					<div class="container">
						<div class="row">
							<div class="col">
								<select class="form-control" style="width: 330px; margin-left: 50px;"
										name="searchContactByTag" id="searchContactByTag">
									<option value="" selected>Search contact by tag</option>
									<option value="family">Family</option>
									<option value="friend">Friend</option>
									<option value="work">Work</option>
									<option value="school">School</option>
								</select>
							</div>
							<div class="col d-flex justify-content-center" style="margin-left: -90px;">
								<input type="text" class="form-control" name="searchContactByName"
									   id="searchContactByName"
									   placeholder="Search Contact by Last name"
									   class="w-100">
								<button class="btn searchUser-btn"><i class="fa fa-search fa-2x"></i></button>
							</div>
						</div>
					</div>
					<hr>
					<div class="contactView-btn">
						<button type="submit" class="btn getAllUser-btn">View All Contacts</i></button>
						<button type="submit" class="btn addContact-btn" id="addContact">New Contact</button>
					</div>
					<div class="table-responsive">
						<hr>
						<table class="table table-hover table-sm contact-table contactData" style="display: none;">
						</table>
						<table class="table table-hover table-sm noContactData" style="display: none;">
							<tbody>
							<tr class="table-light">
								<td>
									<h6 style="text-align: center;">No matching user contacts found...</h6>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<br>
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
								   placeholder="First name *">
						</div>

						<div class="col-md-7">
							<input type="text" class="form-control" name="lastName" id='lastName'
								   placeholder="Last name *">
						</div>
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="email" id="email" placeholder="Email *">
					</div>

					<div class="form-group">
						<input type="text" class="form-control" name="telephoneNo" id="telephoneNo"
							   placeholder="Telephone Number *">
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
							<label>First Name*</label>
							<input type="text" class="form-control" name="editFirstName" id="editFirstName"
								   placeholder="First name">
						</div>

						<div class="col-md-7">
							<label>Last Name*</label>
							<input type="text" class="form-control" name="editLastName" id='editLastName'
								   placeholder="Last name">
						</div>
					</div>

					<div class="form-group">
						<label>Email*</label>
						<input type="text" class="form-control" name="editEmail" id="editEmail" placeholder="Email">
					</div>

					<div class="form-group">
						<label>Telephone No*</label>
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
						<label>Display Picture Url</label>
						<input type="text" class="form-control" name="editDisplayPictureUrl" id="editDisplayPictureUrl"
							   placeholder="Display Picture Url">
					</div>

					<div class="updateContactDiv">
						<button type="submit" class="btn btn-primary btn-block updateContact-btn" id="updateContact"
								name="updateContact">
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
			$(".contactData").hide();
			$(".noContactData").hide();
		});
	});


	/**
	 *
	 * @type {jQuery|void|*}
	 */

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
				var telephoneNo = $('#telephoneNo').val();

				if (firstName && lastName && email && telephoneNo) {

					var contact = new ContactModel({
						firstName: firstName,
						lastName: lastName,
						email: email,
						telephoneNo: telephoneNo
					});
					contact.save();
					contactCollections.add(contact);
					$("#addContactModel").hide();
					alert("Contact created successfully!");
					$('#firstName').val("");
					$('#lastName').val("");
					$('#email').val("");
					$('#telephoneNo').val("");
				} else {
					alert("Failed creating Contact... Check the required fields!");
					$('#firstName').val("");
					$('#lastName').val("");
					$('#email').val("");
					$('#telephoneNo').val("");
				}

			}
		}
	);

	var contactAdd = new ContactCreateView();

	/**
	 *
	 * @type {jQuery|void|*}
	 */

	var ContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('.searchContact'),

			initialize: function () {

				contactCollections.fetch({async: false});
				this.render();
				this.model.on('add', this.render, this);
				this.model.on('change', this.render, this);
			},

			events: {
				"click .searchUser-btn": 'searchUserContact',
				"click .getAllUser-btn": 'getAllUserContact'
			},

			getAllUserContact: function () {
				var self = this;
				// self.$el.empty();

				$("#editContactModel").hide();
				$("#addContactModel").hide();
				$(".noContactData").hide();


				contactCollections.fetch({
					success: function (response) {
						console.log(response);

						if (response.length > 0) {

							$(".contactData").show();

							response.each(function (contactModel) {
								var childDisplayView = new ChildDisplayView({model: contactModel});
								self.$el.append(childDisplayView.render());
							});
						} else {
							$(".contactData").hide();
							$(".noContactData").show();

						}
					}
				});
			},

			searchUserContact: function () {

				var lastName = this.$("#searchContactByName").val();
				var tag = this.$("#searchContactByTag").val();

				// console.log(lastName);
				// console.log(tag);

				var self = this;
				// self.$el.empty();

				if (lastName || tag) {
					// var searchContactCollections = new ContactCollection();

					contactCollections.fetch({
						data: {
							lastName: lastName,
							tag: tag
						},
						success: function (response) {
							console.log(response);

							if (response.length > 0) {

								$(".contactData").show();
								$(".noContactData").hide();

								response.each(function (contactModel) {
									var childDisplayView = new ChildDisplayView({model: contactModel});
									self.$el.append(childDisplayView.render());
								});
							} else {
								$(".contactData").hide();
								$(".noContactData").show();
							}
						}
					});

					$("input#searchContactByName").val("");
					this.$("#searchContactByTag").val("");
					$("#editContactModel").hide();
					$("#addContactModel").hide();


				} else {
					alert("Input either contact tag value or last name to perform search operation");
					$("#editContactModel").hide();
					$("#addContactModel").hide();
				}
			},

			render: function () {
				return this;
			}
		}
	);

	/**
	 *
	 * @type {jQuery|void|*}
	 */
	var ChildDisplayView = Backbone.View.extend({

		el: $('.contactData'),

		tagName: "tr",

		className: "table-light",

		initialize: function () {
		},

		render: function () {
			this.$el.html(this.model.escape(""));

			var self = this;
			this.$el.empty();

			contactCollections.each(function (c) {

				var iteratedContent = `
								<tr class="table-light">
									<td style="width: 10%; height: 50px"><img class="" style="width: 40px; height: 40px; border-radius: 80%;" src=${c.get("displayPictureUrl")}></td>
									<td style="width: 20%; height: 50px">${c.get("firstName")} ${c.get("lastName")}</td>
									<td style="width: 20%; height: 50px">${c.get("email")}</td>
									<td style="width: 10%; height: 50px">${c.get("telephoneNo")}</td>
									<td style="width: 20%; height: 50px">${c.get("contactTags")}</td>
									<td style="width: 10%; height: 50px">
										<div class="editContact">
											<button type="submit" class="editContact-btn" id="${c.get("contactId")}"><i class="fa fa-edit fa-2x"></i></button>
										</div>
									</td>
									<td style="width: 10%; height: 50px">
										<div class="deleteContact">
											<button type="submit" class="deleteContact-btn" id="${c.get("contactId")}"><i class="fa fa-trash fa-2x"></i></button>
										</div>
									</td>
								</tr>`;
				self.$el.append(iteratedContent);
			});
		}
	});

	var contactDisplayView = new ContactDisplayView();

	/**
	 *
	 * @type {jQuery|void|*}
	 */
	var DeleteContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('.contactData'),

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

				alert("Contact deleted successfully!");
			}
		}
	);

	var contactDelete = new DeleteContactDisplayView();

	/**
	 *
	 * @type {jQuery|void|*}
	 */
	var EditContactDisplayView = Backbone.View.extend(
		{
			model: contactCollections,

			el: $('.contactData'),

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

				console.log(event);

				var contactId = event.currentTarget.id;

				var con = contactCollections.get(contactId);

				var firstName = con.get('firstName');
				var lastName = con.get('lastName');
				var email = con.get('email');
				var telephoneNo = con.get('telephoneNo');
				var displayPictureUrl = con.get('displayPictureUrl');
				var contactTags = con.get('contactTags');
				var contactId = con.get('contactId');

				console.log(JSON.stringify(con));

				$("input#editFirstName").val(firstName);
				$("input#editLastName").val(lastName);
				$("input#editEmail").val(email);
				$("input#editTelephoneNo").val(telephoneNo);
				$("input#editDisplayPictureUrl").val(displayPictureUrl);
				$("input#contactTags").val(contactTags);

				$("input#editContactId").val(contactId);
			}
		}
	);

	var contactEdit = new EditContactDisplayView();

	/**
	 *
	 * @type {jQuery|void|*}
	 */
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

				if (firstName && lastName && email && telephoneNo) {

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

					$("#editContactModel").hide();
					$(".contactData").hide();

					alert("Contact updated successfully!");
				} else {
					alert("Failed updating contact... Check the required fields!");
				}
			}
		}
	);

	var contactUpdate = new UpdateContactDisplayView();

</script>
<?php
